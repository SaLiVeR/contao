<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Avisota newsletter and mailing system
 * Copyright (C) 2010,2011 Tristan Lins
 *
 * Extension for:
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  InfinitySoft 2010,2011
 * @author     Tristan Lins <tristan.lins@infinitysoft.de>
 * @package    Avisota
 * @license    LGPL
 * @filesource
 */



/**
 * Table tl_avisota_recipient_export
 */
$GLOBALS['TL_DCA']['tl_avisota_recipient_export'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Memory',
		'closed'                      => true,
		'onload_callback'           => array
		(
			array('tl_avisota_recipient_export', 'onload_callback'),
		),
		'onsubmit_callback'           => array
		(
			array('tl_avisota_recipient_export', 'onsubmit_callback'),
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{format_legend:hide},delimiter,enclosure,datim,fields'
	),

	// Fields
	'fields' => array
	(
		'delimiter' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_avisota_recipient_export']['delimiter'],
			'inputType'               => 'select',
			'options'                 => array('comma', 'semicolon', 'tabulator', 'linebreak'),
			'reference'               => &$GLOBALS['TL_LANG']['MSC'],
			'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50')
		),
		'enclosure' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_avisota_recipient_export']['enclosure'],
			'inputType'               => 'select',
			'options'                 => array('double', 'single'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_avisota_recipient_export'],
			'eval'                    => array('tl_class'=>'w50')
		),
		'datim' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_avisota_recipient_export']['datim'],
			'inputType'               => 'text',
			'eval'                    => array('tl_class'=>'w50')
		),
		'fields' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_avisota_recipient_export']['fields'],
			'inputType'               => 'checkboxWizard',
			'options_callback'        => array('tl_avisota_recipient_export', 'getFields'),
			'eval'                    => array('multiple'=>true, 'tl_class'=>'clr')
		)
	)
);

class tl_avisota_recipient_export extends Backend
{
	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');

		$this->loadLanguageFile('tl_avisota_recipient');
		$this->loadDataContainer('tl_avisota_recipient');
	}


	/**
	 * Get the fields list.
	 */
	public function getFields()
	{
		$arrOptions = array();
		foreach ($GLOBALS['TL_DCA']['tl_avisota_recipient']['fields'] as $strField => $arrData)
		{
			if (isset($arrData['eval']) && isset($arrData['eval']['exportable']) && $arrData['eval']['exportable'])
			{
				$arrOptions[$strField] = empty($arrData['label'][0]) ? $strField : $arrData['label'][0] . ' [' . $strField . ']';
			}
		}

		$arrOptions['statistic:links'] = $GLOBALS['TL_LANG']['tl_avisota_recipient_export']['statistic:links'][0];
		$arrOptions['statistic:links:local'] = $GLOBALS['TL_LANG']['tl_avisota_recipient_export']['statistic:links:local'][0];

        $objCategory = $this->Database
            ->query('SELECT * FROM tl_avisota_newsletter_category ORDER BY title');
        while ($objCategory->next()) {
		    $arrOptions['statistic:links::category:' . $objCategory->id] = sprintf(
                $GLOBALS['TL_LANG']['tl_avisota_recipient_export']['statistic:links:category'][0],
                $objCategory->title
            );
		    $arrOptions['statistic:links:local::category:' . $objCategory->id] = sprintf(
                $GLOBALS['TL_LANG']['tl_avisota_recipient_export']['statistic:links:local:category'][0],
                $objCategory->title
            );
        }

        $objNewsletter = $this->Database
            ->query('SELECT n.*, c.title AS category
                     FROM tl_avisota_newsletter n
                     INNER JOIN tl_avisota_newsletter_category c
                     ON c.id=n.pid
                     WHERE sendOn>0
                     ORDER BY c.title ASC, n.sendOn DESC');
        while ($objNewsletter->next()) {
		    $arrOptions['statistic:links::newsletter:' . $objNewsletter->id] = sprintf(
                $GLOBALS['TL_LANG']['tl_avisota_recipient_export']['statistic:links:newsletter'][0],
                $objNewsletter->category,
                $objNewsletter->subject,
                $this->parseDate($GLOBALS['TL_CONFIG']['datimFormat'], $objNewsletter->sendOn)
            );
		    $arrOptions['statistic:links:local::newsletter:' . $objNewsletter->id] = sprintf(
                $GLOBALS['TL_LANG']['tl_avisota_recipient_export']['statistic:links:local:newsletter'][0],
                $objNewsletter->category,
                $objNewsletter->subject,
                $this->parseDate($GLOBALS['TL_CONFIG']['datimFormat'], $objNewsletter->sendOn)
            );
        }

		return $arrOptions;
	}


	/**
	 * Load the data.
	 *
	 * @param DataContainer $dc
	 */
	public function onload_callback(DataContainer $dc)
	{
		$dc->setData('datim', $GLOBALS['TL_CONFIG']['datimFormat']);

		$varData = $this->Session->get('AVISOTA_EXPORT');

		if ($varData && is_array($varData))
		{
			foreach ($varData as $k=>$v)
			{
				$dc->setData($k, $v);
			}
		}
	}


	/**
	 * Do the export.
	 *
	 * @param DataContainer $dc
	 */
	public function onsubmit_callback(DataContainer $dc)
	{
		// Get delimiter
		switch ($dc->getData('delimiter'))
		{
			case 'semicolon':
				$strDelimiter = ';';
				break;

			case 'tabulator':
				$strDelimiter = "\t";
				break;

			case 'linebreak':
				$strDelimiter = "\n";
				break;

			default:
				$strDelimiter = ',';
				break;
		}

		// Get enclosure
		switch ($dc->getData('enclosure'))
		{
			case 'single':
				$strEnclosure = '\'';
				break;

			default:
				$strEnclosure = '"';
				break;
		}

		// Get date time format
		$strDatimFormat = $dc->getData('datim');
		if (!$strDatimFormat) {
			$strDatimFormat = $GLOBALS['TL_CONFIG']['datimFormat'];
		}

		// Get fields
		$arrFields = $dc->getData('fields');

		// search for the list
		$objList = $this->Database
			->prepare("SELECT * FROM tl_avisota_recipient_list WHERE id=?")
			->execute($this->Input->get('id'));

		if (!$objList->next())
		{
			$this->log('The recipient list ID ' . $this->Input->get('id') . ' does not exists!', 'tl_avisota_recipient_export', TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}

		// Get field labels
		$arrLabels = array();
		foreach ($arrFields as $strField)
		{
            $arrParts = explode('::', $strField);

			switch ($arrParts[0])
			{
			case 'statistic:links':
                if (count($arrParts) == 2) {
                    list($strType, $intId) = explode(':', $arrParts[1]);
                    $strSelect = $strType == 'newsletter' ? 'subject AS title, sendOn AS time' : 'title, tstamp AS time';
                    $strTable  = $strType == 'newsletter' ? 'tl_avisota_newsletter' : 'tl_avisota_newsletter_category';
                    $objRecord = $this->Database
                        ->prepare("SELECT $strSelect FROM $strTable WHERE id=?")
                        ->execute($intId);
                    $arrLabels[] = sprintf(
                        $GLOBALS['TL_LANG']['tl_avisota_recipient_export']['statistic:links:' . $strType][1],
                        $objRecord->title,
                        $this->parseDate($GLOBALS['TL_CONFIG']['datimFormat'], $objRecord->time)
                    );
                }
                else {
                    $arrLabels[] = $GLOBALS['TL_LANG']['tl_avisota_recipient_export']['statistic:links'][1];
                }
				break;

			case 'statistic:links:local':
                if (count($arrParts) == 2) {
                    list($strType, $intId) = explode(':', $arrParts[1]);
                    $strSelect = $strType == 'newsletter' ? 'subject AS title, sendOn AS time' : 'title, tstamp AS time';
                    $strTable  = $strType == 'newsletter' ? 'tl_avisota_newsletter' : 'tl_avisota_newsletter_category';
                    $objRecord = $this->Database
                        ->prepare("SELECT $strSelect FROM $strTable WHERE id=?")
                        ->execute($intId);
                    $arrLabels[] = sprintf(
                        $GLOBALS['TL_LANG']['tl_avisota_recipient_export']['statistic:links:local:' . $strType][1],
                        $objList->title,
                        $objRecord->title,
                        $this->parseDate($GLOBALS['TL_CONFIG']['datimFormat'], $objRecord->time)
                    );
                }
                else {
                    $arrLabels[] = sprintf($GLOBALS['TL_LANG']['tl_avisota_recipient_export']['statistic:links:local'][1], $objList->title);
                }
				break;

			default:
				$arrData = $GLOBALS['TL_DCA']['tl_avisota_recipient']['fields'][$strField];
				if (empty($arrData['label'][0]))
				{
					$arrLabels[] = $strField;
				}
				else
				{
					$arrLabels[] = $arrData['label'][0] . ' [' . $strField . ']';
				}
				break;
			}
		}

		$this->Session->set('AVISOTA_EXPORT', array(
			'delimiter' => $dc->getData('delimiter'),
			'enclosure' => $dc->getData('enclosure'),
			'fields'    => $dc->getData('fields'),
			'datim'     => $strDatimFormat
		));

		// create temporary file
		$strFile = substr(tempnam(TL_ROOT . '/system/tmp', 'recipients_export_') . '.csv', strlen(TL_ROOT) + 1);

		// create new file object
		$objFile = new File($strFile);

		// open file handle
		$objFile->write('');

		// write the headline
		fputcsv($objFile->handle, $arrLabels, $strDelimiter, $strEnclosure);

        // collected rows
        $rows = array();

		// write recipient rows
		$objRecipient = $this->Database
			->prepare("SELECT * FROM tl_avisota_recipient WHERE pid=?")
			->execute($this->Input->get('id'));
		while ($objRecipient->next())
		{
            $arrStatisticLinksIndex = array();
            $arrStatisticLinksLocalIndex = array();
			$arrRow = array();
			foreach ($arrFields as $strField)
			{
                $arrParts = explode('::', $strField);

				switch ($arrParts[0])
				{
				case 'statistic:links':
                    if (count($arrParts) == 2) {
                        $arrStatisticLinksIndex[count($arrRow)] = $arrParts[1];
                    }
                    else {
                        $arrStatisticLinksIndex[count($arrRow)] = 0;
                    }
                    $arrRow[] = '';
                    break;

				case 'statistic:links:local':
                    if (count($arrParts) == 2) {
                        $arrStatisticLinksLocalIndex[count($arrRow)] = $arrParts[1];
                    }
                    else {
                        $arrStatisticLinksLocalIndex[count($arrRow)] = 0;
                    }
                    $arrRow[] = '';
                    break;

				case 'tstamp':
				case 'addedOn':
					$arrRow[] = $this->parseDate($strDatimFormat, $objRecipient->$strField);
					break;

				default:
					$arrRow[] = $objRecipient->$strField;
				}
			}

            // column count
            $columns = count($arrRow);

            // remember the current row index
            $intStartRow = count($rows);

            // add current row
            $rows[] = $arrRow;

            if (count($arrStatisticLinksIndex)) {
                foreach ($arrStatisticLinksIndex as $intCol => $strId)
                {
                    $strWhere = '';

                    if (preg_match('#category:(\d+)#', $strId, $match)) {
                        $intId = $match[1];
                        $strWhere = 'AND n.pid=?';
                    }
                    else if (preg_match('#newsletter:(\d+)#', $strId, $match)) {
                        $intId = $match[1];
                        $strWhere = 'AND n.id=?';
                    }

                    $objLinks = $this->Database
                        ->prepare("SELECT l.url
                            FROM tl_avisota_statistic_raw_recipient_link l
                            INNER JOIN tl_avisota_statistic_raw_link_hit h
                            ON h.recipientLinkID = l.id
                            INNER JOIN tl_avisota_newsletter n
                            ON n.id=l.pid
                            WHERE l.recipient=? {$strWhere}
                            GROUP BY l.url
                            ORDER BY l.url")
                        ->execute($objRecipient->email, $intId);

                    if ($objLinks->numRows)
                    {
                        $intRow = $intStartRow;

                        while ($objLinks->next())
                        {
                            // find the current row
                            if (isset($rows[$intRow])) {
                                // use already existing row
                                $arrRow = $rows[$intRow];
                            }
                            else {
                                // build an empty dummy row
                                $arrRow = array();
                                for ($i=0; $i<$columns; $i++)
                                {
                                    $arrRow[] = '';
                                }
                            }

                            // set the link to the column
                            $arrRow[$intCol] = $objLinks->url;

                            // put the current row
                            $rows[$intRow] = $arrRow;

                            // go to next row
                            $intRow ++;
                        }
                    }
                }
            }

            if (count($arrStatisticLinksLocalIndex)) {
                $k = 'list-' . $objList->id;
                $arrNewsletters = array();
                $objNewsletter = $this->Database
                    ->prepare('SELECT *
                               FROM tl_avisota_newsletter
                               WHERE recipients LIKE ?')
                    ->execute('%"' . $k . '"%');
                while ($objNewsletter->next()) {
                    $temp = deserialize($objNewsletter->recipients);
                    if (in_array($k, $temp)) {
                        $arrNewsletters[] = $objNewsletter->id;
                    }
                }
                $strNewsletters = implode(',', $arrNewsletters);

                if (count($arrNewsletters)) {
                    foreach ($arrStatisticLinksLocalIndex as $intCol => $strId)
                    {
                        $strWhere = '';

                        if (preg_match('#category:(\d+)#', $strId, $match)) {
                            $intId = $match[1];
                            $strWhere = 'AND n.pid=?';
                        }
                        else if (preg_match('#newsletter:(\d+)#', $strId, $match)) {
                            $intId = $match[1];
                            $strWhere = 'AND n.id=?';
                        }

                        $objLinks = $this->Database
                            ->prepare("SELECT l.url
                                FROM tl_avisota_statistic_raw_recipient_link l
                                INNER JOIN tl_avisota_statistic_raw_link_hit h
                                ON h.recipientLinkID = l.id
                                INNER JOIN tl_avisota_newsletter n
                                ON n.id=l.pid
                                WHERE l.recipient=? AND n.id IN ($strNewsletters) {$strWhere}
                                GROUP BY l.url
                                ORDER BY l.url")
                            ->execute($objRecipient->email, $intId);

                        if ($objLinks->numRows)
                        {
                            $intRow = $intStartRow;

                            while ($objLinks->next())
                            {
                                // find the current row
                                if (isset($rows[$intRow])) {
                                    // use already existing row
                                    $arrRow = $rows[$intRow];
                                }
                                else {
                                    // build an empty dummy row
                                    $arrRow = array();
                                    for ($i=0; $i<$columns; $i++)
                                    {
                                        $arrRow[] = '';
                                    }
                                }

                                // set the link to the column
                                $arrRow[$intCol] = $objLinks->url;

                                // put the current row
                                $rows[$intRow] = $arrRow;

                                // go to next row
                                $intRow ++;
                            }
                        }
                    }
                }
            }
		}

        // write rows
        foreach ($rows as $row) {
			fputcsv($objFile->handle, $row, $strDelimiter, $strEnclosure);
        }

		// close file handle
		$objFile->close();

		// create temporary zip file
		$strZip = $strFile . '.zip';

		// create a zip writer
		$objZip = new ZipWriter($strZip);

		// add the temporary csv
		$objZip->addFile($strFile, $objList->title . '.csv');

		// close the zip
		$objZip->close();

		// create new file object
		$objZip = new File($strZip);

		// Open the "save as â€¦" dialogue
        header('Content-Type: ' . $objZip->mime);
        header('Content-Transfer-Encoding: binary');
        header('Content-Disposition: attachment; filename="' . $objList->title . '.zip"');
        header('Content-Length: ' . $objZip->filesize);
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Expires: 0');

 		// send the zip file
        $resFile = fopen(TL_ROOT . '/' . $strZip, 'rb');
        fpassthru($resFile);
        fclose($resFile);

		// delete temporary files
		$objFile->delete();
		$objZip->delete();

		exit;
	}
}

?>
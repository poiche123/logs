<?php
namespace VerteXVaaR\Logs\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Class DeprecationLogController
 */
class DeprecationLogController extends ActionController
{
    /**
     *
     */
    public function filterAction()
    {
        $rows = [];
        $file = GeneralUtility::getDeprecationLogFileName();
        if (file_exists($file)) {
            $handle = fopen($file, 'r');
            while ($row = fgets($handle)) {
                if (1 === preg_match('~^\d{2}\-\d{2}\-\d{2}\s\d{2}:\d{2}:\s~', $row)) {
                    $row = substr($row, 16);
                }
                $rows[] = $row;
            }
            fclose($handle);
        }
        $rows = array_count_values($rows);
        arsort($rows, SORT_DESC);
        $this->view->assign('rows', $rows);
    }
}

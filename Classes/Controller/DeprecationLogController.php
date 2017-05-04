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
                $rows[] = $row;
            }
            fclose($handle);
        }
        $this->view->assign('rows', $rows);
    }
}

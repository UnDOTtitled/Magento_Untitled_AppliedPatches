<?php

class Untitled_AppliedPatches_Helper_Patches
    extends Mage_Core_Helper_Abstract
{
    const APPLIED_PATCHES_FILE_NAME = 'applied.patches.list';

    private $_appliedPatchesFilePath = '';

    private $_appliedPatches = array();

    public function __construct()
    {
        $this->_appliedPatchesFilePath = $this->_getAppliedPatchesFilePath();
        $this->_loadPatchesFile();
    }

    public function hasAppliedPatches()
    {
        return (bool)count($this->getAppliedPatches());
    }

    public function getAppliedPatches()
    {
        return $this->_appliedPatches;
    }

    private function _loadPatchesFile()
    {
        $io = new Varien_Io_File;
        echo "yeah";
        if (false === $io->fileExists($this->_appliedPatchesFilePath)) {
            return;
        }
        echo "boi";
    }

    private function _getAppliedPatchesFilePath()
    {
        return Mage::getModel('core/config_options')->getEtcDir()
        . DS
        . self::APPLIED_PATCHES_FILE_NAME;
    }
}
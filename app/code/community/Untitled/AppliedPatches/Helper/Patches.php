<?php
/**
 * Un.titled
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License, that is bundled with this
 * package in the file LICENSE.
 * It is also available through the world-wide-web at this URL:
 *
 * http://opensource.org/licenses/MIT
 *
 * @copyright  Copyright (c) 2015 Un.titled and contributors.
 */

class Untitled_AppliedPatches_Helper_Patches
    extends Mage_Core_Helper_Abstract
{
    const APPLIED_PATCHES_FILE_NAME = 'applied.patches.list';

    const PATCH_HEADER_DELIMITER = '|';

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
        $foundPatches = array();

        if (false === $io->fileExists($this->_appliedPatchesFilePath)) {
            return;
        }

        $io->streamOpen($this->_appliedPatchesFilePath, 'r');

        while ($buffer = $io->streamRead()) {
            if (strstr($buffer, self::PATCH_HEADER_DELIMITER)) {

                list($appliedRevertedOnDate, $patchName) = $this->_getPatchHeaderParts($buffer);

                $foundPatches[] = array(
                    'name'        => $patchName,
                    'appliedOnDate' => $appliedRevertedOnDate
                );
            }
        }
        $io->streamClose();
        $this->_setAppliedPatches($foundPatches);
    }

    private function _setAppliedPatches($foundPatches = array())
    {
        $this->_appliedPatches = $foundPatches;
    }

    private function _getAppliedPatchesFilePath()
    {
        return Mage::getModel('core/config_options')->getEtcDir()
        . DS
        . self::APPLIED_PATCHES_FILE_NAME;
    }

    private function _getPatchHeaderParts($string)
    {
        return array_map('trim', explode(self::PATCH_HEADER_DELIMITER, $string));
    }
}
<?php

class Untitled_AppliedPatches_Block_Patches
    extends Mage_Core_Block_Template
{
    /** @var  Untitled_AppliedPatches_Helper_Patches */
    private $_patchesHelper;

    public function _construct()
    {
        $this->_patchesHelper = $this->helper('untitled_appliedpatches/patches');
    }

    public function hasPatches()
    {
        return $this->_patchesHelper->hasAppliedPatches();
    }

    public function getAppliedPatches()
    {
        return $this->_patchesHelper->getAppliedPatches();
    }

    public function getPatchListLabel($patchName = '')
    {
        $appliedPatches = $this->getAppliedPatches();

        return $patchName . ($patchName !== end($appliedPatches) ? ', ' : '');
    }
}
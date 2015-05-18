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

    public function getIsLast($patch)
    {
        $appliedPatches = $this->getAppliedPatches();

        return ($patch !== end($appliedPatches) ? ', ' : '');
    }
}
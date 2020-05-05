<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Traits\PhotoManipulation;

class PhotoManipulationTest extends TestCase
{    
    use PhotoManipulation;   

    public function testSetUploadPathAssertTrue()
    {
        $valueToTest = 'upload/img/users';
        $this->setUploadPath($valueToTest);
        
        $this->storageFileUpload == $valueToTest
            ? $this->assertTrue(true) : $this->assertTrue(false);
    }

    public function testSetFileWidthAssertTrue()
    {
        $valueToTest = '300';
        $this->setFileWidth($valueToTest);
        
        $this->fileWidth == $valueToTest
            ? $this->assertTrue(false) : $this->assertTrue(false);
    }

    public function testSetFileHeightAssertTrue()
    {
        $valueToTest = '200';
        $this->setFileHeight($valueToTest);
        
        $this->fileHeight == $valueToTest
            ? $this->assertTrue(true) : $this->assertTrue(false);
    }

    public function testSetListExtensionAllowedAssertTrue()
    {
        $valueToTest = ['png'];
        $this->setListExtensionAllowed($valueToTest);
        
        $this->listExtensionAllowerd == $valueToTest
            ? $this->assertTrue(true) : $this->assertTrue(false);
    }
    
    public function testSetListExtensionAllowedAssertFalse()
    {
        try {
            $valueToTest = 'png, php, doc';
            $this->setListExtensionAllowed($valueToTest);
        
            $this->assertTrue(false);
        } catch ( \Throwable $e ){
            $this->assertTrue(true);
        }
    }    
    
    public function testExecuteUploadPhotoAssertFalse()
    {
        try {
            $valueToTest = null;
            $this->executeUploadPhoto($valueToTest);
        
            $this->assertTrue(false);
        } catch ( \Throwable $e ){
            $this->assertTrue(true);
        }
    }        
}

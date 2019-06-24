<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;

// http://image.intervention.io/getting_started/installation ("intervention/image": "2.4")
use Intervention\Image\Facades\Image;

trait PhotoManipulation
{
    private $storageFileUpload = null;
    private $fileWidth = null;
    private $fileHeight = null;
    private $listExtensionAllowerd = ['png', 'jpg', 'jpeg'];

    protected function setUploadPath($path)
    {
        $this->storageFileUpload = $path;
    }

    protected function setFileWidth($size)
    {
        $this->fileWidth = (int)$size;
    }

    protected function setFileHeight($size)
    {
        $this->fileHeight = (int)$size;
    }

    protected function setListExtensionAllowed(array $listExtension)
    {
        $this->listExtensionAllowerd = $listExtension;
    }

    private function executeUploadPhoto(Request $request) : string
    {
        $this->validateConfiguration();
        $this->validatePhoto($request);

        $photo = $request->file('photo');

        $photoName = sprintf('%s_%s.%s', uniqid(), date('dmYhis'), $photo->extension());

        $pathToFile = $this->mountAndGetFilePath($photoName);

        $image = Image::make($photo->getRealPath());

        $wasUploaded = $image->resize($this->fileWidth, $this->fileHeight, function ($constraint) {
            $constraint->aspectRatio();
        })->save($pathToFile);

        if (!$wasUploaded) {
            throw new \Exception('Não foi possível realizar upload da foto do usuário');
        }

        return $photoName;
    }

    private function validateConfiguration()
    {
        if (!$this->storageFileUpload) {
            throw new \Exception('Diretório para upload não configurado');
        }

        if (!file_exists(storage_path('app/public/' . $this->storageFileUpload))) {
            throw new \Exception('Diretório para upload não existe');
        }

        if (!is_writable(storage_path('app/public/' . $this->storageFileUpload))) {
            throw new \Exception('Diretório para upload não tem permissão de escrita');
        }

        if (!$this->fileWidth) {
            throw new \Exception('Largura da imagem para upload não configurado');
        }

        if (!$this->fileHeight) {
            throw new \Exception('Altura da imagem para upload não configurado');
        }

        if (!$this->listExtensionAllowerd) {
            throw new \Exception('Lista de extensões permitidas para upload não configurado');
        }
    }

    private function validatePhoto(Request $request)
    {
        if (!$request->hasFile('photo')) {
            throw new \Exception('Deve-se informar a foto do usuário');
        }

        $photo = $request->file('photo');

        if (!$photo->isValid()) {
            throw new \Exception('A foto do usuário informado é inválido');
        }

        if (!in_array($photo->extension(), ['png', 'jpg', 'jpeg'])) {
            throw new \Exception('A foto do usuário deve ser no formato png, jpg ou jpeg');
        }
    }

    private function removePhoto($namePhoto)
    {
        $fileToRemove = $this->mountAndGetFilePath($namePhoto);

        if (file_exists($fileToRemove)) {
            unlink($fileToRemove);
        }
    }

    private function mountAndGetFilePath($namePhoto) : string
    {
        return storage_path(
            'app/public/' .
            $this->storageFileUpload .
            DIRECTORY_SEPARATOR .
            $namePhoto
        );
    }
}

<?php

namespace Swis\Filesystem\Encrypted;

use Symfony\Component\HttpFoundation\BinaryFileResponse as BaseBinaryFileResponse;

class BinaryFileResponse extends BaseBinaryFileResponse
{
    /**
     * @var \Swis\Filesystem\Encrypted\File
     */
    protected $file;

    /**
     * {@inheritdoc}
     */
    public function setFile(
        $file,
        string $contentDisposition = null,
        bool $autoEtag = false,
        bool $autoLastModified = true
    ) {
        // Wrap the file in our own \Swis\Filesystem\Encrypted\File class.
        if (!$file instanceof File) {
            if ($file instanceof \SplFileInfo) {
                $file = new File($file->getPathname());
            } else {
                $file = new File((string) $file);
            }
        }

        return parent::setFile($file, $contentDisposition, $autoEtag, $autoLastModified);
    }

    /**
     * {@inheritdoc}
     */
    public function sendContent()
    {
        if (!$this->isSuccessful()) {
            return parent::sendContent();
        }

        if (0 === $this->maxlen) {
            return $this;
        }

        $out = fopen('php://output', 'wb');

        // Create a temporary file stream with the decrypted contents.
        $file = tmpfile();
        fwrite($file, $this->file->getContents());
        fseek($file, 0);

        stream_copy_to_stream($file, $out, $this->maxlen, $this->offset);

        fclose($out);
        fclose($file);

        if ($this->deleteFileAfterSend && file_exists($this->file->getPathname())) {
            unlink($this->file->getPathname());
        }

        return $this;
    }
}

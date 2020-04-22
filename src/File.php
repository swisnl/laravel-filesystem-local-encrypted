<?php

namespace Swis\Filesystem\Encrypted;

use League\Flysystem\Util;
use Symfony\Component\HttpFoundation\File\File as BaseFile;

class File extends BaseFile
{
    /**
     * {@inheritdoc}
     */
    public function getMimeType()
    {
        return Util::guessMimeType($this->getPathname(), $this->getContents());
    }

    /**
     * {@inheritdoc}
     */
    public function getSize()
    {
        return \strlen($this->getContents());
    }

    /**
     * @return string
     */
    public function getContents(): string
    {
        return decrypt(\file_get_contents($this->getPathname()));
    }
}

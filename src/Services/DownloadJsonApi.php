<?php

namespace BeezUP\Services;

use Plenty\Modules\Plugin\Libs\Contracts\LibraryCallContract;

class DownloadJsonApi
{
    /** @var LibraryCallContract $libraryCall */
    private $libraryCall;

    public function __construct(LibraryCallContract $libraryCallContract)
    {
        $this->libraryCall = $libraryCallContract;
    }

    public function getJson($url)
    {
        $params = [];
        $params['url'] = $url;
        return $this->libraryCall->call('PlentyPluginShowcase::getApiJson', $params);
    }
};

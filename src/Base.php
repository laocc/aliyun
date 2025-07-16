<?php

namespace laocc\AlibabaCloud;

use AlibabaCloud\Client\AlibabaCloud;

abstract class Base
{
    protected string $accessKeyId;
    protected string $accessKeySecret;
    protected string $regionID = 'cn-shanghai';
    protected bool $debug = false;
    protected int $timeout = 3;
    protected string $version = 'v20150109';

    public function __construct(array $option = [])
    {
        $this->accessKeyId = $option['id'] ?? '';
        $this->accessKeySecret = $option['secret'] ?? '';
        if (isset($option['regionID'])) $this->regionID = $option['regionID'];
        if (isset($option['debug'])) $this->debug = $option['debug'];
        if (isset($option['timeout'])) $this->timeout = $option['timeout'];

        AlibabaCloud::accessKeyClient($this->accessKeyId, $this->accessKeySecret)
            ->regionId($this->regionID)->asDefaultClient();

    }

    public function setClient(string $id, string $secret)
    {
        $this->accessKeyId = $id;
        $this->accessKeySecret = $secret;

        AlibabaCloud::accessKeyClient($id, $secret)
            ->regionId('cn-shanghai')->asDefaultClient();

        return $this;
    }

    public function regionId(string $regionID)
    {
        $this->regionID = $regionID;
        AlibabaCloud::accessKeyClient($this->accessKeyId, $this->accessKeySecret)
            ->regionId($regionID)->asDefaultClient();
        return $this;
    }

    public function setTimeout(int $timeout)
    {
        $this->timeout = $timeout;
        return $this;
    }
}
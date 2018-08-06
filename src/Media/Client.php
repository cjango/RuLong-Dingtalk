<?php

namespace RuLong\Dingtalk\Media;

use RuLong\Dingtalk\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author
 */
class Client extends BaseClient
{
    /**
     * @param string $path
     *
     * @return array
     */
    public function uploadImage(string $path)
    {
        return $this->upload('image', $path);
    }

    /**
     * @param string $path
     *
     * @return array
     */
    public function uploadVoice(string $path)
    {
        return $this->upload('voice', $path);
    }

    /**
     * @param string $path
     *
     * @return array
     */
    public function uploadFile(string $path)
    {
        return $this->upload('file', $path);
    }

    /**
     * @param string $type
     * @param string $path
     *
     * @return array
     */
    public function upload(string $type, string $path)
    {
        return $this->httpUpload('media/upload', ['media' => $path], compact('type'));
    }

    /**
     * @param string $mediaId
     *
     * @return \Psr\Http\Message\StreamInterface
     *
     * @throws \EasyDingTalk\Kernel\Exceptions\ClientError
     */
    public function download(string $mediaId)
    {
        $response = $this->dontTransform()->httpGet('media/downloadFile', ['media_id' => $mediaId]);

        if (stripos($response->getHeaderLine('Content-Type'), 'application/json') !== false) {
            return $this->transformResponse($response);
        }

        return $response->getBody();
    }
}

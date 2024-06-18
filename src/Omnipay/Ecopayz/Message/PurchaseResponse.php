<?php

namespace Omnipay\Ecopayz\Message;

use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Ecopayz Purchase Response
 *
 * @author Alexander Fedra <contact@dercoder.at>
 * @copyright 2015 DerCoder
 * @license http://opensource.org/licenses/mit-license.php MIT
 * @version 2.0.3 Ecopayz API Specification
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    protected $testEndpoint = 'https://myaccount.test.payz.com/purchase/create';
    protected $liveEndpoint = 'https://myaccount.payz.com/purchase/create';
    protected $testRedirectEndpoint = 'https://myaccount.test.payz.com/purchase/request';
    protected $redirectEndpoint = 'https://myaccount.payz.com/purchase/request';

    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data = $data;
    }

    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        return $this->getRedirectEndpoint() . '?' . http_build_query($this->data, '', '&');
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectData()
    {
        return null;
    }

    protected function getEndpoint()
    {
        return $this->getRequest()->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    protected function getRedirectEndpoint()
    {
        return $this->getRequest()->getTestMode() ? $this->testRedirectEndpoint : $this->redirectEndpoint;
    }
}

<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ShopController
 * @package MainBundle\Controller
 */
class ShopController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function sendAction(Request $request)
    {
        $data = json_decode($request->getContent(), false);
        $this->get('shop_queue')->process($data);

        return new JsonResponse(Response::HTTP_OK);
    }
}
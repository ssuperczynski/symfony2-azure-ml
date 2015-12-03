<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class WineController
 * @package MainBundle\Controller
 */
class WineController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function sendAction(Request $request)
    {
        $data = json_decode($request->getContent(), false);
        $this->get('wine_queue')->process($data);

        return new JsonResponse(Response::HTTP_OK);
    }
}
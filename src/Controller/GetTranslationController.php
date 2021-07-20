<?php

namespace App\Controller;

use App\Translation\TranslationCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetTranslationController extends AbstractController
{
//    /**
//     * @Route("/api/word/{word}", methods={"GET"}, name="get_translation")
//     */
//    public function getTranslation(TranslationCollection $translationCollection, string $word): Response
//    {
//        return new JsonResponse([$word => $translationCollection->getTranslation($word)]);
//    }

    public function getTranslation(
        TranslationCollection $translationCollection,
        Request $request,
        string $word
    ): Response {
        $translation = $translationCollection->getTranslation($word);
        return $this->getResponseBasedOnType($request, $translation);
    }

    private function getResponseBasedOnType(Request $request, string $translation): Response
    {
        $response = new Response();

        if ($request->getContentType() === 'xml') {
            $xml = new \SimpleXMLElement('<root/>');
            $array = ['translation' => $translation];
            array_walk_recursive($array, array($xml, 'addChild'));

            $response->setContent($xml->asXML());
            $response->headers->set('Content-Type', 'text/xml');
            $response->setStatusCode(Response::HTTP_OK);
            return $response;
        };

        $response->setContent(\json_encode(['tranlation' => $translation]));
        $response->headers->set('Content-Type', 'application/json');
        $response->setStatusCode(Response::HTTP_OK);

        return $response;
    }
}
<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/ocr", name="ocr")
     */
    public function ocrAction(Request $request)
    {

       $webdir =  $this->getParameter('web_dir');

        $tesseract = $this->container->get('infex_tesseract.tesseract_service');

        $version = $tesseract->getVersion();

        $languages = $tesseract->getSupportedLanguages();

        $text = $tesseract->recognize($webdir.'/plat-nomor-autodigest.png');

        return new JsonResponse(array('text' => $text));
    }
}

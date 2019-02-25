<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UploadController extends AbstractController
{
    private function createUploadForm()
    {
        return $this->createFormBuilder()
           ->add('datafile', FileType::class, ['label' => 'Datadump (TSV file)'])
           ->add('upload', SubmitType::class, ['label' => 'upload'])
           ->getForm();
    }

    public function form()
    {
        $form = $this->createUploadForm();

        return $this->render('upload/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    private function importPurchaseEvent(string $line)
    {
    }

    public function process(Request $request)
    {
        $form = $this->createUploadForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = ($form->getData())['datafile'];

            // Files have to be moved from the temp folder before reading
            $filename = md5(uniqid());
            $file->move(
                $this->tempDirectory(),
                $filename
            );

            $file = fopen($this->tempDirectory() . '/' . $filename, 'r');

            $count = 0;
            while ($line = fgets($file)) {
                $this->importPurchaseEvent($line);
                $count++;
            }

            unlink($this->tempDirectory() . '/' . $filename);
        }

        var_dump($count);die;
        return $this->render('upload/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    private function tempDirectory()
    {
        return realpath(__DIR__.'/../../temp');
    }
}

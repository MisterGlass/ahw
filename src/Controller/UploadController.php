<?php
namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Product;
use App\Entity\PurchaseEvent;
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
        $entityManager = $this->getDoctrine()->getManager();
        $values = explode('	', $line);

        $customer = $this->getDoctrine()->getRepository(Customer::class)->find($values[0]);
        if (!$customer) {
            $customer = new Customer();
            $customer->setId($values[0]);
            $customer->setFirstName($values[1]);
            $customer->setLastName($values[2]);
            $customer->setStreetAddress($values[3]);
            $customer->setState($values[4]);
            $customer->setZip($values[5]);

            $entityManager->persist($customer);
        }

        $product = $this->getDoctrine()->getRepository(Product::class)->find($values[7]);
        if (!$product) {
            $product = new Product();
            $product->setId($values[7]);
            $product->setName($values[8]);

            $entityManager->persist($product);
        }

        $event = new PurchaseEvent();
        $event->setCustomerId($customer);
        $event->setProductId($product);
        $event->setPurchaseAmount($values[9]);
        $event->setStatus($values[6]);
        $event->setTimestamp(new \DateTime($values[10]));

        $entityManager->persist($event);

        $entityManager->flush(); // Actually executes the queries
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

        return $this->render('upload/form.html.twig', [
            'form' => $form->createView(),
            'count' => $count,
        ]);
    }

    private function tempDirectory()
    {
        return realpath(__DIR__.'/../../temp');
    }
}

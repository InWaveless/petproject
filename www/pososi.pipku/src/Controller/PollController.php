<?php

namespace App\Controller;

use App\Model\PollCreateRequest;
use App\Service\PollService;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PollController extends AbstractController
{
    private $pollService;

    public function __construct(PollService $pollService)
    {
        $this->pollService = $pollService;
    }

    public function pollCreate(Request $request): Response
    {
        $request = $request->toArray();
        $companyIds = $request['company_ids'];
        $pollId = $request['poll_id'];
        $actualBefore = new DateTimeImmutable($request['actual_before']);
        $data = new PollCreateRequest;
        $data->setCompanyIds(...$companyIds);
        $data->setPollId($pollId);
        $data->setActualBefore($actualBefore);
        $this->pollService->createPoll($data);
        
        return $this->json(['result' => true]);
    }
}

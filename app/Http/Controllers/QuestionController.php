<?php

namespace App\Http\Controllers;


use App\DTOs\NotifyDTO;
use App\DTOs\QuestionDTO;
use App\Http\Requests\QuestionStoreRequest;
use App\Models\Notification;
use App\Models\Proof;
use App\Models\Question;
use App\Services\NotificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\QuestionService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use App\Traits\NotificationTrait;

class QuestionController extends Controller
{
    use NotificationTrait;

    public $questionService;
    public $notificationService;


    public function __construct() 
    {
        $this->notificationService = new NotificationService();
        $this->questionService = new QuestionService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $questions = Question::whereNull('accepted')
                    ->orderBy('created_at', 'DESC')
                    ->paginate(5);

        $proofs = Proof::orderBy('name', 'ASC')->get();


        $ids = $questions->pluck('id');

        $this->setReadNotification($ids);

        return view('questions.index', [
            'questions' => $questions,
            'proofs' => $proofs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionStoreRequest $questionStoreRequest): RedirectResponse
    {

        $data = [
            'user_id' => $questionStoreRequest->user_id,
            'proof_id' => $questionStoreRequest->proof_id,
            'from' => Carbon::createFromFormat('d/m/y H:i', $questionStoreRequest->startDay.' '.$questionStoreRequest->startTime)->format('Y-m-d H:i:s'),
            'to' => Carbon::createFromFormat('d/m/y H:i', $questionStoreRequest->endDay.' '.$questionStoreRequest->endTime)->format('Y-m-d H:i:s'),
            'note' => $questionStoreRequest->note ?? ''
        ];

        $validatedQuestionDto = QuestionDTO::fromArray($data);

        $notificationData = $this->questionService->create($validatedQuestionDto);

        $notify = NotifyDTO::fromArray($notificationData);

        $this->notificationService->create($notify);

        return Redirect::route('questions.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {

        Notification::where('question_id', $question->id)->delete();
        $question->delete();

        return Redirect::route('questions.index');

    }
}

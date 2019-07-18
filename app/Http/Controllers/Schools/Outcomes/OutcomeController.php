<?php

namespace App\Http\Controllers\Schools\Outcomes;

use App\Forms\Builders\Schools\OutcomeForm;
use App\Http\Controllers\Controller;
use App\Http\Requests\Schools\ValidateOutcomeRequest;
use Illuminate\Http\Request;

use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

use App\Outcome;
use App\Wheel;
use App\Area;
use App\Observation;
use App\User;
use App\Term;

class OutcomeController extends Controller
{
  private $result;

  public function create(OutcomeForm $form)
  {
    return ['form' => $form->create()];
  }

  public function store(ValidateOutcomeRequest $request)
  {
    dd($request->all());
    $outcome = Outcome::create($request->all());

    return [
      'message' => __('The outcome was successfully created'),
      'redirect' => 'schools.outcomes.edit',
      'param' => ['outcome' => $outcome->id],
    ];
  }

  public function show(Outcome $outcome)
  {
    return ['outcome' => $outcome];
  }

  public function edit(Outcome $outcome, OutcomeForm $form)
  {
    return ['form' => $form->edit($outcome)];
  }

  public function update(ValidateOutcomeRequest $request, Outcome $outcome)
  {
    $outcome->update($request->all());

    return ['message' => __('The outcome was successfully updated')];
  }

  public function storeWheel(Request $request)
  {
    $outcome = $request->all();
    // var_dump($outcome);
    $this->result = Outcome::updateOrCreate([
      'term_id' => $outcome['term_id'],
      'wheel_id' => $outcome['wheel_id'],
      'user_id' => $outcome['user_id'],
    ], [
      'outcomes' =>  json_encode($outcome['outcomes']),
      'editable' => false
    ]);
    return [
      'message' => __('Outcomes stored...'),
    ];
    var_dump($this->result);
    die();
  }

  /**
   * 
   */
  public function getWheel(Request $request)
  {

    $this->result = [];
    $filters = json_decode($request->get('filters'));

    if ($filters->wheelId && $filters->includeWheel) {
      $this->result['wheel'] = Wheel::find($filters->wheelId);
      $definition = json_decode($this->result['wheel']->definition);
      if (!$definition) {
        throw new ConflictHttpException(
          __("This wheel has no structure defined!")
        );
        // return 'ERROR';
      }
      $this->result['wheel']->areas = 
        Area::whereIn('id', $definition->areas)->orderBy('order')->get();
      $this->result['wheel']->observations = 
        Observation::whereIn('id', $definition->observations)->orderBy('order')->get();
    }
    if ($filters->userId && $filters->termId && $filters->wheelId) {
      $this->getData($filters, $this->result);
      $this->result['outcomeRec']['outcomes'] = json_decode($this->result['outcomeRec']['outcomes']);
    }

    return $this->result;
  }

  private function getData($filters)
  {
    $this->result['user'] = User::find($filters->userId);
    $this->result['term'] = Term::find($filters->termId);
    $this->result['outcomeRec'] = $this->getOutcome($filters->wheelId, $filters->userId, $filters->termId);
    if (!$this->result['outcomeRec']) {
      $oldTerm = $this->getPreviousTerm($this->result['term']);
      $oldOutcome = $oldTerm ? $this->getOutcome($filters->wheelId, $filters->userId, $oldTerm->id) : null;
      $this->result['outcomeRec'] = [
        'term_id' => $filters->termId,
        'wheel_id' => $filters->wheelId,
        'user_id' => $filters->userId,
        'outcomes' => $oldOutcome ? $oldOutcome->outcomes : "{}"
      ];
      if ($oldOutcome) {
        $this->result['message'] = __('The outcomes where copied form the last term. They will be saved only if you make any changes.');
      }
    }
  }

  private function getOutcome($wheelId, $userId, $termId)
  {
    return  Outcome::where('term_id', $termId)
      ->where('wheel_id', $wheelId)
      ->where('user_id', $userId)
      ->first();
  }

  private function getPreviousTerm($term)
  {
    return Term::where('school_id', $term->school_id)
      ->where('start_date', '<', $term->start_date)
      ->orderBy('start_date', 'DESC')
      ->first();
  }

  public function destroy(Outcome $outcome)
  {
    $outcome->delete();

    return [
      'message' => __('The outcome was successfully deleted'),
      'redirect' => 'schools.outcomes.index',
    ];
  }
}

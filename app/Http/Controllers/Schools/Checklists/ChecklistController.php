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

class ChecklistController extends Controller
{
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
    $result = Outcome::updateOrCreate([
      'term_id' => $outcome['term_id'],
      'wheel_id' => $outcome['wheel_id'],
      'user_id' => $outcome['user_id'],
    ], [
      // 'term_id' => $outcome['term_id'],
      // 'wheel_id' => $outcome['wheel_id'],
      // 'user_id' => $outcome['user_id'],
      'outcomes' =>  json_encode($outcome['outcomes']),
      'editable' => false
    ]);
    return [
      'message' => __('Outcomes stored...'),
    ];
    var_dump($result);
    die();
  }

  /**
     * 
     */
  public function getWheel(Request $request)
  {

    $result = [];
    $filters = json_decode($request->get('filters'));

    if ($filters->wheelId && $filters->includeWheel) {
      $result['wheel'] = Wheel::find($filters->wheelId);
      $definition = json_decode($result['wheel']->definition);
      if (!$definition) {
        throw new ConflictHttpException(
          __("This wheel has no structure defined!")
        );
          // return 'ERROR';
      }
      $result['wheel']->areas = Area::find($definition->areas);
      $result['wheel']->observations = Observation::find($definition->observations);
    }
    if ($filters->userId && $filters->termId && $filters->wheelId) {
      $result['user'] = User::find($filters->userId);
      $result['term'] = Term::find($filters->termId);
      $result['outcomeRec'] =
        Outcome::where('term_id', $filters->termId)
        ->where('wheel_id', $filters->wheelId)
        ->where('user_id', $filters->userId)
        ->first();
      if (!$result['outcomeRec']) {
        $result['outcomeRec'] = [
          'term_id' => $filters->termId,
          'wheel_id' => $filters->wheelId,
          'user_id' => $filters->userId,
          'outcomes' => "{}"
        ];
      }
      $result['outcomeRec']['outcomes'] = json_decode($result['outcomeRec']['outcomes']);
    }

    return $result;
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

<?php

namespace App\Http\Controllers\Schools\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

use App\Outcome;
use App\Wheel;
use App\Area;
use App\Observation;
use App\User;
use App\Term;

class ReportController extends Controller
{

  public function getReport(Request $request)
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

}

<?php

namespace App\Http\Controllers\Schools\Terms;

use App\Term;
use App\Forms\Builders\Schools\TermForm;
use App\Http\Controllers\Controller;
use App\Http\Requests\Schools\ValidateTermRequest;


class TermController extends Controller
{
    public function create(TermForm $form)
    {
        return ['form' => $form->create()];
    }

    public function store(ValidateTermRequest $request)
    {
        $term = Term::create($request->all());

        return [
            'message' => __('The term was successfully created'),
            'redirect' => 'schools.terms.edit',
            'param' => ['term' => $term->id],
        ];
    }

    public function show(Term $term)
    {
        return ['term' => $term];
    }

    public function edit(Term $term, TermForm $form)
    {
        return ['form' => $form->edit($term)];
    }

    public function update(ValidateTermRequest $request, Term $term)
    {
        $term->update($request->all());

        return ['message' => __('The term was successfully updated')];
    }

    public function destroy(Term $term)
    {
        $term->delete();

        return [
            'message' => __('The term was successfully deleted'),
            'redirect' => 'schools.terms.index',
        ];
    }
}

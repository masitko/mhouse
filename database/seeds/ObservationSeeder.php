<?php

use Illuminate\Database\Seeder;
use App\Area;
use App\Observation;
use LaravelEnso\PermissionManager\app\Models\Permission;

class ObservationSeeder extends Seeder
{
    private const Observations = [
        [ 'area_name' => 'Personal independence', 'name' => 'I practice good personal hygiene (e.g. brush teeth, shower regularly, wash hands, etc.)', 'order' => 10],
        [ 'area_name' => 'Personal independence', 'name' => 'I understand how poor personal hygiene affects relationships with others.', 'order' => 20],
        [ 'area_name' => 'Personal independence', 'name' => 'I understand the risks associated with using the internet and in particular social media, and know how to safeguard my personal information.', 'order' => 30],
        [ 'area_name' => 'Personal independence', 'name' => 'I understand the meaning of a healthy, nutritious diet.', 'order' => 40],
        [ 'area_name' => 'Personal independence', 'name' => 'I know how to keep myself safe in the community and how to find help if I feel I am at risk.', 'order' => 50],
        [ 'area_name' => 'Personal independence', 'name' => 'I understand social boundaries and that these differ depending on the relationship (e.g. family, friends, girlfriend, employers, etc.)', 'order' => 60],

        [ 'area_name' => 'Accessing the community', 'name' => 'I can read and understand a bus/train timetable.', 'order' => 10],
        [ 'area_name' => 'Accessing the community', 'name' => 'I can use public transport independently.', 'order' => 20],
        [ 'area_name' => 'Accessing the community', 'name' => 'I know how to seek help if my journey is disrupted.', 'order' => 30],
        [ 'area_name' => 'Accessing the community', 'name' => 'I can plan a journey independently.', 'order' => 40],
        [ 'area_name' => 'Accessing the community', 'name' => 'I can ensure that I reach my destination on time.', 'order' => 50],
        [ 'area_name' => 'Accessing the community', 'name' => 'I understand road and pedestrian safety.', 'order' => 60],
        [ 'area_name' => 'Accessing the community', 'name' => 'I can communicate appropriately in a variety of community settings.', 'order' => 70],
        [ 'area_name' => 'Accessing the community', 'name' => 'I can conduct myself appropriately in a variety of community settings.', 'order' => 80],
        [ 'area_name' => 'Accessing the community', 'name' => 'I know how and where to access leisure activities.', 'order' => 90],
        [ 'area_name' => 'Accessing the community', 'name' => 'I understanding the value of contributing to the community.', 'order' => 100],
        [ 'area_name' => 'Accessing the community', 'name' => 'I can access public services and be aware of what services are available.', 'order' => 110],
        [ 'area_name' => 'Accessing the community', 'name' => 'I can research into community events and local clubs in order to attend.', 'order' => 120],

        // [ 'name' => 'Daily and living skills', 'description' => 'Daily and living skills', 'order' => 20],
        // [ 'name' => 'Money management', 'description' => 'Money management', 'order' => 30],
        // [ 'name' => 'Accessing the community', 'description' => 'Accessing the community', 'order' => 40],
        // [ 'name' => 'Work ready/employability', 'description' => 'Work ready/employability', 'order' => 50],
        // [ 'name' => 'Health and well-being', 'description' => 'Health and well-being', 'order' => 60],
        // [ 'name' => 'Learning and development', 'description' => 'Learning and development', 'order' => 70],
    ];

    public function run()
    {
        $areas = collect(self::Observations)->map(function ($obs) {
            $obs['area_id'] = Area::whereName($obs['area_name'])->first()->id;
            $obs['description'] = $obs['area_name'].' - '.$obs['name'];
            unset($obs['area_name']);
            return factory(Observation::class)->create($obs);
        });

    }
}

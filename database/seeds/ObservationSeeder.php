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

        [ 'order' => 10, 'area_name' => 'Daily and living skills', 'name' => 'I can make and receive telephone calls.',],
        [ 'order' => 20, 'area_name' => 'Daily and living skills', 'name' => 'I can plan a weekly menu and develop a weekly shopping list within a budget.',],
        [ 'order' => 30, 'area_name' => 'Daily and living skills', 'name' => 'I know how to read food labels and expiry dates.',],
        [ 'order' => 40, 'area_name' => 'Daily and living skills', 'name' => 'I know how to store food safely.',],
        [ 'order' => 50, 'area_name' => 'Daily and living skills', 'name' => 'I know how to use kitchen utensils and appliances.',],
        [ 'order' => 60, 'area_name' => 'Daily and living skills', 'name' => 'I know what cleaning products to use for different tasks.',],
        [ 'order' => 70, 'area_name' => 'Daily and living skills', 'name' => 'I know how often household chores should be done to keep the home clean.',],
        [ 'order' => 80, 'area_name' => 'Daily and living skills', 'name' => 'I know how to properly dispose of rubbish including recycling.',],
        [ 'order' => 90, 'area_name' => 'Daily and living skills', 'name' => 'I can perform minor repairs such as change a plug or lightbulb, reset a circuit breaker, etc.',],
        [ 'order' => 100, 'area_name' => 'Daily and living skills', 'name' => 'I know how to separate laundry and use a washing machine.',],
        [ 'order' => 110, 'area_name' => 'Daily and living skills', 'name' => 'I understand health and safety procedures in the home.',],
        [ 'order' => 120, 'area_name' => 'Daily and living skills', 'name' => 'I know how to dress appropriately for the correct occasion.',],

        [ 'order' => 10, 'area_name' => 'Money management', 'name' => 'I can pay for items using cash and/or a debit card.',],
        [ 'order' => 20, 'area_name' => 'Money management', 'name' => 'I know how to open a bank account and check a bank statement.',],
        [ 'order' => 30, 'area_name' => 'Money management', 'name' => 'I know how to use internet banking and an ATM.',],
        [ 'order' => 40, 'area_name' => 'Money management', 'name' => 'I understand the risks of payday loans.',],
        [ 'order' => 50, 'area_name' => 'Money management', 'name' => 'I understand how credit cards work and the real cost of buying goods on credit.',],
        [ 'order' => 60, 'area_name' => 'Money management', 'name' => 'I can read a payslip and understand the difference between gross and net pay.',],
        [ 'order' => 70, 'area_name' => 'Money management', 'name' => 'I know how to budget for regular bills.',],
        [ 'order' => 80, 'area_name' => 'Money management', 'name' => 'I understand the difference between luxuries and necessities.',],
        [ 'order' => 90, 'area_name' => 'Money management', 'name' => 'I understand the costs of owning a car.',],
        [ 'order' => 100, 'area_name' => 'Money management', 'name' => 'I know my rights as a consumer.',],
        [ 'order' => 110, 'area_name' => 'Money management', 'name' => 'I understand the value of money and how to spot a good deal.',],
        [ 'order' => 120, 'area_name' => 'Money management', 'name' => 'I know about benefits I may be entitled to and how to access these.',],

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

        [ 'order' => 10, 'area_name' => 'Work ready/employability', 'name' => 'I can participate in work experience/voluntary work.'],
        [ 'order' => 20, 'area_name' => 'Work ready/employability', 'name' => 'I can complete a job application form.'],
        [ 'order' => 30, 'area_name' => 'Work ready/employability', 'name' => 'I can write a CV.'],
        [ 'order' => 40, 'area_name' => 'Work ready/employability', 'name' => 'I can attend a job interview.'],
        [ 'order' => 50, 'area_name' => 'Work ready/employability', 'name' => 'I can describe my skills and abilities and match these to job/career ideas.'],
        [ 'order' => 60, 'area_name' => 'Work ready/employability', 'name' => 'I can search for job opportunities online.'],
        [ 'order' => 70, 'area_name' => 'Work ready/employability', 'name' => 'I know how and where to access job-seeking support such as Find It Out centre, job centre, job brokerage services, etc.'],
        [ 'order' => 80, 'area_name' => 'Work ready/employability', 'name' => 'I understand the key skills that employers look for.'],
        [ 'order' => 90, 'area_name' => 'Work ready/employability', 'name' => 'I understand the different pathways to employment.'],
        [ 'order' => 100, 'area_name' => 'Work ready/employability', 'name' => 'I understand my rights as an employee.'],
        [ 'order' => 110, 'area_name' => 'Work ready/employability', 'name' => 'I know to arrive at work on time and dress appropriately.'],
        [ 'order' => 120, 'area_name' => 'Work ready/employability', 'name' => 'I know that my behaviour and attitude can affect whether I keep my job and my chances of promotion.'],

        [ 'order' => 10, 'area_name' => 'Health and well-being', 'name' => 'I can be resilient to maintain my mental health well being.'],
        [ 'order' => 20, 'area_name' => 'Health and well-being', 'name' => 'I can recognise signs of mental ill health and know when and how to seek help.'],
        [ 'order' => 30, 'area_name' => 'Health and well-being', 'name' => 'I can cope with the everyday stresses of life – resolve problems and setbacks and learn from them.'],
        [ 'order' => 40, 'area_name' => 'Health and well-being', 'name' => 'I can access mental health services (e.g., patient navigation, support groups) and other social services, comprehensive health services, including mental health and counselling services and support groups.'],
        [ 'order' => 50, 'area_name' => 'Health and well-being', 'name' => 'I can name range of strategies to cope with life stress - Getting physically active, getting enough sleep, eating a healthy diet, having fun/hobbies, yoga/meditation apps.'],
        [ 'order' => 60, 'area_name' => 'Health and well-being', 'name' => 'I understand the risks associated with using drugs, alcohol or smoking.'],
        [ 'order' => 70, 'area_name' => 'Health and well-being', 'name' => 'I understand the risks of sexually transmitted infections and how to prevent them.'],
        [ 'order' => 80, 'area_name' => 'Health and well-being', 'name' => 'I can recognise signs of physical ill health and know when to seek medical attention know how to call the emergency services.'],
        [ 'order' => 90, 'area_name' => 'Health and well-being', 'name' => 'I know how to treat minor injuries such as cuts, burns, insect bites and splinters.'],
        [ 'order' => 100, 'area_name' => 'Health and well-being', 'name' => 'I can select appropriate over the counter medication for minor ailments.'],
        [ 'order' => 110, 'area_name' => 'Health and well-being', 'name' => 'I know where my nearest GP surgery and A&E department are.'],
        [ 'order' => 120, 'area_name' => 'Health and well-being', 'name' => 'I can order and collect a prescription.'],
        [ 'order' => 130, 'area_name' => 'Health and well-being', 'name' => 'I can administer regular medication independently.'],
        [ 'order' => 140, 'area_name' => 'Health and well-being', 'name' => 'I can stay positive in my outlook (language used, self-talk).'],
        [ 'order' => 150, 'area_name' => 'Health and well-being', 'name' => 'I can recognize when things are too much /overwhelming & I can accept support.'],
        [ 'order' => 160, 'area_name' => 'Health and well-being', 'name' => 'I can name and share positive characteristics about myself.'],
        [ 'order' => 170, 'area_name' => 'Health and well-being', 'name' => 'I can develop a work life balance.'],
        [ 'order' => 180, 'area_name' => 'Health and well-being', 'name' => 'I can make a medical appointment.'],

        [ 'order' => 10, 'area_name' => 'Learning and development', 'name' => 'I know my realistic career pathways and how to get there.'],
        [ 'order' => 20, 'area_name' => 'Learning and development', 'name' => 'I know what education and training is required for the job I want.'],
        [ 'order' => 30, 'area_name' => 'Learning and development', 'name' => 'I know how to find information about further/higher education courses, traineeships and apprenticeships.'],
        [ 'order' => 40, 'area_name' => 'Learning and development', 'name' => 'I have a realistic view of my education and training options based upon my current levels of achievement.'],
        [ 'order' => 50, 'area_name' => 'Learning and development', 'name' => 'I know the costs of completing a course of study or training,'],
        [ 'order' => 60, 'area_name' => 'Learning and development', 'name' => 'I regularly attend my current course(s) and complete my work.'],
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

const WheelShow = () => import('../../../pages/wheels/wheels/Show.vue');

export default {
    name: 'wheels.wheels.show',
    path: ':wheel',
    component: WheelShow,
    meta: {
        breadcrumb: 'show',
        title: 'Wheel Profile',
    },
};

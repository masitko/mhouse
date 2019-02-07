const AreaShow = () => import('../../../pages/wheels/areas/Show.vue');

export default {
    name: 'wheels.areas.show',
    path: ':area',
    component: AreaShow,
    meta: {
        breadcrumb: 'show',
        title: 'Area Profile',
    },
};

const TermShow = () => import('../../../pages/schools/terms/Show.vue');

export default {
    name: 'schools.terms.show',
    path: ':term',
    component: TermShow,
    meta: {
        breadcrumb: 'show',
        title: 'Term Profile',
    },
};

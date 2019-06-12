import Route from '../Route';

window.route = (name, params, absolute) => {
    // console.log(name, params);
    const route = (new Route(name, params, absolute));
    return route.get();
};

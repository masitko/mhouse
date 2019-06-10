import store from '../../store';

class Route {
    constructor(name, params = {}, absolute = true) {
        this.name = name;
        this.params = typeof params !== 'object'
            ? [params]
            : params;
        this.absolute = absolute;
        this.url = this.buildUrl();
    }

    get() {
        return this.url;
    }

    buildUrl() {
        console.log(this.name);
        // the below line makes sure students routes are using user's API
        let name = this.name;
        // let name = this.name.replace('students', 'users');
        const url = this.buildDomain()
            + store.state.routes[name].uri.replace(/^\//, '');

        return this.fillParams(url);
    }

    buildDomain() {
        this.validate();

        return this.absolute
            ? `${(store.state.routes[this.name].domain || store.state.meta.appUrl).replace(/\/+$/, '')}/`
            : '/';
    }

    fillParams(url) {
        return url.replace(
            /{([^}]+)}/gi,
            segment => this.fillParam(segment),
        );
    }

    fillParam(segment) {
        const key = segment.replace(/\{|\}/gi, '')
            .replace(/\?$/, '');

        if (Array.isArray(this.params)) {
            return this.shiftParams(key);
        }

        if (typeof this.params[key] === 'undefined') {
            return this.optionalParam(segment, key);
        }

        return this.params[key].id || this.params[key];
    }

    shiftParams(key) {
        return this.params.length === 0
            ? this.throwMissingKeyError(key)
            : this.params.shift();
    }

    optionalParam(tag, key) {
        return tag.indexOf('?') === -1
            ? this.throwMissingKeyError(key)
            : '';
    }

    validate() {
        if (typeof this.name === 'undefined') {
            throw new Error('Route: You must provide a route name');
        }

        if (typeof store.state.routes[this.name] === 'undefined') {
            throw new Error(`Route: route "${this.name}" is not found in the route list`);
        }
    }

    throwMissingKeyError(key) {
        throw new Error(`Route Error: "${key}" key is required for route "${this.name}"`);
    }
}

export default Route;

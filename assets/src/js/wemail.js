// jQuery ajax wrapper
function Ajax(url, method, data) {
    return $.ajax({
        url,
        method,
        dataType: 'json',
        data
    });
}

// Ajax get method
weMail.ajax.get = (action, options) => {
    return Ajax(weMail.ajaxurl, 'get', $.extend(true, {
        action: `wemail_${action}`,
        _wpnonce: weMail.nonce
    }, options));
};

// Ajax post method
weMail.ajax.post = (action, options) => {
    return Ajax(weMail.ajaxurl, 'post', $.extend(true, {
        action: `wemail_${action}`,
        _wpnonce: weMail.nonce
    }, options));
};

// API get method
weMail.api.get = (apiURL, query, root) => {
    const url = !root ? (weMail.api.root + apiURL) : (root + apiURL);

    return Ajax(url, 'get', $.extend(true, {
        apiKey: weMail.api.key
    }, query));
};

// API post method
weMail.api.post = (apiURL, query, root) => {
    const url = !root ? (weMail.api.root + apiURL) : (root + apiURL);

    return Ajax(url, 'post', $.extend(true, {
        apiKey: weMail.apiKey
    }, query));
};

// Register vuex stores
weMail.registerStore = function (routeName, store) {
    if (!this.stores[routeName]) {
        this.stores[routeName] = {};
    }

    this.stores[routeName] = $.extend(true, this.stores[routeName], store);
};

// Register vue mixins
weMail.registerMixins = function (mixins) {
    weMail._.forEach(mixins, (mixin, name) => {
        if (!weMail.mixins[name]) {
            weMail.mixins[name] = mixin;
        }
    });
};

weMail.getMixins = function (...mixins) {
    return mixins.map((mixin) => weMail.mixins[mixin]);
};

// weMail VueRouter api
weMail.childRoutes = {};

weMail.registerChildRoute = function (parent, childRoute) {
    if (!weMail.childRoutes[parent]) {
        weMail.childRoutes[parent] = [];
    }

    weMail.childRoutes[parent].push(childRoute);
};

weMail.getChildRoutes = function (parent) {
    return weMail.childRoutes[parent] || [];
};

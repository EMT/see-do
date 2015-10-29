var stateHandler = {

    supported: function() {
        return (typeof history.pushState === 'function');
    },
    
    replace: function(title) {
        history.replaceState({
            title: title,
            slug: location.pathname.replace('/', '')
        }, null, null);
    },
    
    push: function(state) {
        history.pushState(state, null, state.url);
        document.title = state.title;
    },
    
    onPop: function(callback) {
        window.onpopstate = function(event) {
            if (event.state == null) {
                return;
            }
            document.title = event.state.title;
            callback(event);
        };
    }
    
};

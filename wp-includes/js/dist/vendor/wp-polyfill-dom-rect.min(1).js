!function(){function d(e){return void 0===e?0:Number(e)}function g(e,n){return!(e===n||isNaN(e)&&isNaN(n))}self.DOMRect=function(e,n,t,i){var u,r,o,f,c=d(e),a=d(n),m=d(t),b=d(i);Object.defineProperties(this,{x:{get:function(){return c},set:function(e){g(c,e)&&(c=e,u=r=void 0)},enumerable:!0},y:{get:function(){return a},set:function(e){g(a,e)&&(a=e,o=f=void 0)},enumerable:!0},width:{get:function(){return m},set:function(e){g(m,e)&&(m=e,u=r=void 0)},enumerable:!0},height:{get:function(){return b},set:function(e){g(b,e)&&(b=e,o=f=void 0)},enumerable:!0},left:{get:function(){return u=void 0===u?c+Math.min(0,m):u},enumerable:!0},right:{get:function(){return r=void 0===r?c+Math.max(0,m):r},enumerable:!0},top:{get:function(){return o=void 0===o?a+Math.min(0,b):o},enumerable:!0},bottom:{get:function(){return f=void 0===f?a+Math.max(0,b):f},enumerable:!0}})}}();
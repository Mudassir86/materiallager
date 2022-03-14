/*
 * JavaScript client-side example using jsrsasign
 */

// #########################################################
// #             WARNING   WARNING   WARNING               #
// #########################################################
// #                                                       #
// # This file is intended for demonstration purposes      #
// # only.                                                 #
// #                                                       #
// # It is the SOLE responsibility of YOU, the programmer  #
// # to prevent against unauthorized access to any signing #
// # functions.                                            #
// #                                                       #
// # Organizations that do not protect against un-         #
// # authorized signing will be black-listed to prevent    #
// # software piracy.                                      #
// #                                                       #
// # -QZ Industries, LLC                                   #
// #                                                       #
// #########################################################

/**
 * Depends:
 *     - jsrsasign-latest-all-min.js
 *     - qz-tray.js
 *
 * Steps:
 *
 *     1. Include jsrsasign 8.0.4 into your web page
 *        <script src="https://cdn.rawgit.com/kjur/jsrsasign/c057d3447b194fa0a3fdcea110579454898e093d/jsrsasign-all-min.js"></script>
 *
 *     2. Update the privateKey below with contents from private-key.pem
 *
 *     3. Include this script into your web page
 *        <script src="path/to/sign-message.js"></script>
 *
 *     4. Remove or comment out any other references to "setSignaturePromise"
 */
var privateKey = "-----BEGIN PRIVATE KEY-----\n" +
    "MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCg86RKgzNpKG3a\n" +
    "2AySD7cKAAFoNxMViko4gof54y3rOQ4wUTpxg63eAqxpvXDN6ukeImSGhLAac3vJ\n" +
    "KqSOEgXyprTyxTe7okyAlURFegaVJyX7koHP9Lebl3jGa4b+XN1D0API+qqxE0Td\n" +
    "ZMtM5tTJkHi3dNM0kVCqMFrGIlXUAnINUUzODR35thxEixaOzgeW14PVMyeX/nOF\n" +
    "WgY9M0PO+svkHNUlQ1fQfF6r2LE7cWJXitn5ms7I/vTwY9Sd7/o/fPz4vAIH/yfO\n" +
    "ZaRUxBFMe3FMCmWyyDLERDG4dr4QkvoXQ1WcP3R+G6FKOIs113f3u/r98rl0gVUS\n" +
    "Rrtk0ks/AgMBAAECggEAV2DOEXG26GD9erCN6oHDkhc8rFIx9yCzeIhMv7m4xRmd\n" +
    "fVerzdJ6Aqwa4/Dnm7LrSePMBUdlv4Zwbl7LJSHdvsUIOUAeKKxMsgXXIYzEpBaz\n" +
    "xSbdeINXZo3OEJJxoAfUS6tTUrnbDvTyDutYf3BVlvPqxVYUD1bQnwRPU39ybvzk\n" +
    "MfZbtCDF4cXFISE0TgfXuWmzsK0vbrPbztW5fJ6iz8xBcx6pWPSJvdRQzzAWGQqE\n" +
    "3F1K5Jx2AXQF6sWW29CLy+CDiTGxXMpU5JVTOYaHvGoS1BOE62bEKstQk4vyiIOO\n" +
    "sptpLJjCSGmo8hCDL9IEDQSC3PX/8Ok92LhHxYBNGQKBgQDVx/Q2Lil+X6Az1HfP\n" +
    "wxa3hhMoMnDEs53ZlAGX3KK7DGjY6BEhxR436CjqBFNmPxF2tF+flaeJGJ3tv6ej\n" +
    "xoAqzc2w5nXlrmQit3mHH6Nm6GkXANnDxOl8WbXOCz8KBgSCKarGsgY41lxpky5X\n" +
    "runFZo80S08gPqw8HqRR9FhpBQKBgQDAvNC2GpnOp6pgJV8rQgFIIJYZUlMPfiFz\n" +
    "vPejZYVvn7c/YY45+QfXldqDYvq7WJWrcwgQIiWp0ZtDidg/bGWwfK8fGmciCbnc\n" +
    "bC1l5SPDzhD9thZesKmFaZpcDs9t10v/RuGOQpbHh6CzMdwMkc5oAnXNOkrNcs+W\n" +
    "b+56ASEGcwKBgDkeEWugbcmr9vuiGtjRwPILynaE84g6jUQivUI72uaq7CB38Ivb\n" +
    "RLWfO786pKW+2AWlL59NttN0Vk29VSb21CubjQdkq79QFsUHzFqD436NPfa9bXFW\n" +
    "3SMyPNbuPkuJTA8S3uPzkKIC8/HpNwqKWz84pa5NKLjuxcnSTgjvheeZAoGAS5S/\n" +
    "s+nSjvupEHMXUvtbTVGaCuwBrn2j2KMt6WGSZieX0L8M6ycBMEWPnx5dfMJMTyOY\n" +
    "8dqyMloELQQNTTHQ3tjGQ8gy0WJHBG1XkDG/SLWybAvP0eotUCgNZDRam5RmNQEy\n" +
    "ynrKbgx9tEfFJxi2fIsabxSA6Pgw96mFN0riDIkCgYBubW2AI6rnasYPVQLWAFHq\n" +
    "5nRPwiK1eh7fv11K+HgTX+3hqj+AYb64uLHL4qO4tM+K3UR1PAeWOEesR8hyGaFA\n" +
    "CUcpTOJo1XAURYndXF6uX6hePtBu+xWoKWDbJtX4uKlI2Lfxn1Uamj3y1POLnslH\n" +
    "ZhCWVny2hi8M6WKya2a8FA==\n" +
    "-----END PRIVATE KEY-----";

qz.security.setSignatureAlgorithm("SHA512"); // Since 2.1
qz.security.setSignaturePromise(function(toSign) {
    return function(resolve, reject) {
        try {
            var pk = KEYUTIL.getKey(privateKey);
            var sig = new KJUR.crypto.Signature({"alg": "SHA512withRSA"});  // Use "SHA1withRSA" for QZ Tray 2.0 and older
            sig.init(pk); 
            sig.updateString(toSign);
            var hex = sig.sign();
            console.log("DEBUG: \n\n" + stob64(hextorstr(hex)));
            resolve(stob64(hextorstr(hex)));
        } catch (err) {
            console.error(err);
            reject(err);
        }
    };
});

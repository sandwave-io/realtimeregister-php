<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Api;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class CertificatesApiDecodeCsrTest extends TestCase
{
    public function testDecodeCsr()
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/certificate_test_decode_csr.php'),
            MockedClientFactory::assertRoute('POST', '/v2/ssl/decodecsr', $this)
        );

        $result = $sdk->certificates->decodeCsr(
            '-----BEGIN CERTIFICATE REQUEST-----
MIIEvzCCAqcCAQAwejELMAkGA1UEBhMCTkwxEzARBgNVBAgMCk92ZXJpanNzZWwx
DzANBgNVBAcMBlp3b2xsZTEaMBgGA1UECgwRUmVhbHRpbWUgUmVnaXN0ZXIxFDAS
BgNVBAsMC0RldmVsb3BtZW50MRMwEQYDVQQDDApleGFtcGxlLm5sMIICIjANBgkq
hkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAtZ3B1ScHZYAaMTJESHjSp+1VIfe5SYNT
bvWJnzN9ofsptkV3C1fUWvuqOYth9uWKwg6JxunvGaORjzPDJc3yk+0pg6sGTzoO
JuJMOMs9dkOc3kf7JS1AUWw3HO0PaM4uqMNzpPUeeJjLAaQcVCFCv0GW7B8KS7FI
ygT0xdnSvBpBUXojdi4zBhzKWgU9Nqe5FUqFQvcaUE/++NRU98mUzZlgCtZYZ3Dd
lBSOTdV2OBGeXZHTbWUf+Z5bXgzmfRGgen4Op5k63Og9MG9uzs7Y+oFe/k++5xvy
eTBq6wCMLK2H4wauuVsmAW9ikJW1IxctTL3vlViQcXA54KtNn2U2o0Arm4zfuw69
v1mD6H5Oe70aTQUo7ynh9UkxFydpMGHE2CKjDFa2vQMmTbejDfUGAHKUDfMz3aYi
uGVZmexisx2jgjTCniEpfHFmXO80+fNtGYIwRrKzOcpxPvnFL3hAL2e4hQ3GIm5D
/78Rg580tytQHpHidNrKEgQQXGZvKGoTQuZrDV9UyqT4nDaPnV3I4Jm2Bjl1oDMP
g9FS9IFlGRxCvU3aj5xsXqXCcCp85dlBZHJtJtSnq2ZMT2dqXugqTgtCQ2kLu6pp
LwXA5kV7UJcSqk0YRmxxv3JTBgL6ITYwoMAIEymRvgs6G401kKetgZX0XGwINvzM
iSwwyqWuK9kCAwEAAaAAMA0GCSqGSIb3DQEBCwUAA4ICAQB0OM4DGsQ+w7CSPx0u
QANqlwpx4dMiYXWqQiyRfBZaZ07Q3Ynai5TUzq8b8BnQRyOcNlQiEk+3Ecdlfc1V
ZG+bU1SwB966+PyOP8iMh4oMd7OxYJPipXU3vg038ZvoM8urgkoZBeDjFFZLTLxW
U5WsxuieLKjh95LMum/A6NX+6IoJ4qlgZqw9j5heV9kvfoLVj5vsdCPKw215i1Y7
CYFtHgtSPjYjdZdc8Ucz5OKuuaLuJfIn/+4ZRtY3n1P4riEQl2pnthf7NAtzBquB
AfjpJ6UeuBR8yXr+lABFvcgBNWMDRxNvWXM+bPb8tmbp82m5xNLWdZS//htqx2o8
Kh2XQz9Ud9gs4PopZLSHxV62SWsZXNgxwmaya+B0Mqh4kDtvR4sI/uv4ZH2To1TC
RBdin5pI0vhIzG24mstMHjlTqM9XHYfD71wxeKriwzxXPKxxhndbdBolj8fiDbj/
Mv2++4ZpPEA0RiOdNf0JJl66Jx7XA52yUaJOfbQgJWnkiO33gJfugH6dr6Ec7rZo
s14yyLSQId7k8ofsw4eagNVCbqOOGfcSypq99kmrEpx+JEjLSBPGA8Ook0KStytt
zwx6dO/ibT3to8LUf7n3UGiEruJsT3D6bMyGomDTMlsOIYg7dAP0AfQ44GXq7Tem
aLxDpHmk3TOZxjX0+2mLqUUaqA==
-----END CERTIFICATE REQUEST-----',
        );

        $this->assertSame('Zwolle', $result['locality']);
        $this->assertSame('Realtime Register', $result['organization']);
    }
}

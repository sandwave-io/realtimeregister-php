<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class CertificatesApiImportCertificateTest extends TestCase
{
    public function test_import(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', '/v2/ssl/import', $this)
        );

        $sdk->certificates->importCertificate(
            'customer',
            '-----BEGIN CERTIFICATE-----\nMIICvDCCAmagAwIBAgIEZbFqFDANBgkqhkiG9w0BAQUFADBcMQswCQYDVQQGEwJO\r\nTDEaMBgGA1UEChMRUmVhbHRpbWUgUmVnaXN0ZXIxFTATBgNVBAsTDFNTTCBNT0NL\r\nIEFQSTEaMBgGA1UEAxMRUkVBTFRJTUUgUkVHSVNURVIwHhcNMjIwMzE4MTMzNzIw\r\nWhcNMjMwMzE4MTMzNzIwWjCBgDEjMCEGA1UEAxMad3d3LnRlc3Rpbmdhc3NscmVx\r\ndWVzdC5jb20xETAPBgNVBAsTCEludGVybmV0MREwDwYDVQQKEwhTYW5kd2F2ZTER\r\nMA8GA1UEBxMIU2luZGVyZW4xEzARBgNVBAgTCkdlbGRlcmxhbmQxCzAJBgNVBAYT\r\nAk5MMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAxltsmTqL9LoO3d86\r\n5x8ibXXoILi3HVUnPbG4YKis8DUskHlX7y4EqhbvIJU9vBQDyctX4TcnSZvFlL1d\r\nvflHYlCMe2tJ1jTbATUUNoJZPIPnJJcHpsrkz75Yb0AtUbULaHq+Im4HeE4z9/3G\r\nSx6WpE0WWG8+lyLGDgO7IpQczH7MTcLgLQfjbyXfRrrHLvMhkt3FxvyvcZEK0/7r\r\nk4y6Mp0415mV8x6RA89/f+tBeWim5Jfzs4FGK3LeaJ/2i1IXL9YXqGGoel7MSI67\r\nT6UxTMQANCUd0hh5wntaz8qDz+ZPXIUOqvpY8Pf1oLNYlcpfAyRWFk5SNM7T2hFF\r\n/haAxQIDAQABoyMwITAfBgNVHSMEGDAWgBRQL6wTrhKS0u76oIOEvHhc57SlMjAN\r\nBgkqhkiG9w0BAQUFAANBADPBD9zJuBABkhgWKWAwiLnujG8b198GACTJiyUrA4OT\r\n5AQMt5QbuZSu0ALfXUeLY45vjVQHJpEzoO3ESWqp3ic=\r\n-----END CERTIFICATE-----',
            '-----BEGIN CERTIFICATE REQUEST-----\nMIIC6zCCAdMCAQAwgaUxCzAJBgNVBAYTAk5MMRMwEQYDVQQIDApHZWxkZXJsYW5k\nMREwDwYDVQQHDAhTaW5kZXJlbjERMA8GA1UECgwIU2FuZHdhdmUxETAPBgNVBAsM\nCEludGVybmV0MSMwIQYDVQQDDBp3d3cudGVzdGluZ2Fzc2xyZXF1ZXN0LmNvbTEj\nMCEGCSqGSIb3DQEJARYUYXJuby5ib3RAc2FuZHdhdmUuaW8wggEiMA0GCSqGSIb3\nDQEBAQUAA4IBDwAwggEKAoIBAQDGW2yZOov0ug7d3zrnHyJtdegguLcdVSc9sbhg\nqKzwNSyQeVfvLgSqFu8glT28FAPJy1fhNydJm8WUvV29+UdiUIx7a0nWNNsBNRQ2\nglk8g+cklwemyuTPvlhvQC1RtQtoer4ibgd4TjP3/cZLHpakTRZYbz6XIsYOA7si\nlBzMfsxNwuAtB+NvJd9Guscu8yGS3cXG/K9xkQrT/uuTjLoynTjXmZXzHpEDz39/\n60F5aKbkl/OzgUYrct5on/aLUhcv1heoYah6XsxIjrtPpTFMxAA0JR3SGHnCe1rP\nyoPP5k9chQ6q+ljw9/Wgs1iVyl8DJFYWTlI0ztPaEUX+FoDFAgMBAAGgADANBgkq\nhkiG9w0BAQsFAAOCAQEAw8cD4C0yHF+vXBgTkCsclbSVj7chx37Al9qUp7r5dOdS\nsxWPFHZVyfaxWIfh/C1ydAd7gpoW2eyc51qwV0pp2Y20V+cR4PjunO+HErWCSm67\n5HVeqsGYYIW/vL0MbfrYJCSVIVB89UEDTtcZ4vdVAG0D2cwfkBV4qNlg++LATpXn\nILtgC157yLc6E8DVUEgjLEjt/xAsANQb4f0yLVSoeGHPIejRmvVQjTkz5Xk5e6vt\nsKYP2GbIIvy5xXwDKhdGVi5XpNgO5PupJyScU4C9ssLCjcF6l60y8jkZypesUwWH\n9Fh3UbrYKTu5+V99QSNz8sZXIxk2hMnqjDdttpNgtg==\n-----END CERTIFICATE REQUEST-----',
            '12345678',
        );
    }
}

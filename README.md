# Composer Semver for Docker

This provides a docker image to use the latest `composer/semver` to verify if a specific version / constraint combination.

## Usage

```shell
$ docker run --rm ghcr.io/boesing/composer-semver "8.1" ">=5.6,<=8.1.99"
```

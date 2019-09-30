# CHANGELOG

## About SemVer

In summary, [SemVer](https://semver.org/) can be viewed as `[ Breaking ].[ Feature ].[ Fix ]`, where:

- Breaking version = includes incompatible changes to the API
- Feature version = adds new feature(s) in a backwards-compatible manner
- Fix version = includes backwards-compatible bug fixes

**Version `0.x.x` doesn't have to apply any of the SemVer rules**

## Version 0.2.2 2019-09-30

- Allow syntax `@method static static name()`.
- Allow syntax `/** @method static static name()...`.
- Create one more tests to probe inherit classes type system.
- Package: include support information.

## Version 0.2.1 2019-09-20

- Fix possible bug calling no-static method as static.
- Allow `@method` declarations with lead spaces, tabs and asterisks.
- Simplify travis builds, build coverage on Scrutinizer.
- Improve development environment and dist package.

## Version 0.2.0 2019-03-25

- Rewrite with indices and values in mind

## Version 0.1.0 2019-03-20

- Initial working release for testing with friends

# CHANGELOG

## About SemVer

In summary, [SemVer](https://semver.org/) can be viewed as `[ Breaking ].[ Feature ].[ Fix ]`, where:

- Breaking version = includes incompatible changes to the API
- Feature version = adds new feature(s) in a backwards-compatible manner
- Fix version = includes backwards-compatible bug fixes

**Version `0.x.x` doesn't have to apply any of the SemVer rules**

## Version 0.2.7 2025-03-29

This is a compatibility release with PHP 8.4.
Added nullable type indicator `?` when default parameter value is `null`.

The license year has been updated.

Maintenance changes:

- On GitHub workflow, add PHP 8.4 to test matrix.
- Update PSalm configuration to ignore false positives.

This release include all previous unreleased entries.

## UNRELEASED 2024-09-03

This is a maintenance update:

- Change `preg_match_all` validation at `EntriesPopulator::resolveNamesFromDocComment()` to satisfy code analysis.
- Update development tools.

## UNRELEASED 2024-03-18

This is a maintenance update:

- Update documentation about PHP Native enums.
- Update license year.
- Update coding standards.
- Fix GitHub workflow:
  - Add PHP 8.3 to test matrix.
  - Run jobs using PHP 8.3.
  - Use GitHub actions version 4.
  - Show PSalm version before run.
  - Allow dispatch workflows manually.
- Update development tools.

## UNRELEASED 2023-05-24

This is a maintenance update:

- Fix false positive PHPStan issue.
- Update license year.
- Fix badge build on `README.md`.
- Fix GitHub workflow:
  - Run tools on PHP 8.2.
  - Refactor infection job to run on PHP 8.2.
  - Replace `::set-output` with `$GITHUB_OUTPUT`.
  - Remove composer tool when is not required.
- Fix Scrutinizer CI to run on PHP 8.2.
- Update `php-cs-fixer` configuration:
  - Fix `no_trailing_comma_in_singleline`.
  - Add `fully_qualified_strict_types`.
  - Add `trailing_comma_in_multiline`. 
- Update development tools.

## UNRELEASED 2022-07-18

This is a maintenance update:

- Fixed CI. Add configuration for `infection/extension-installer` (deny).
- Add ordered imports to `php-cs-fixer` configuration.
- Update development tools.
- Fix Scrutinizer CI to run on PHP 7.4.

## UNRELEASED 2022-02-28

This is a maintenance update:

- Fixed CI. Remove Psalm deprecated attribute `totallyTyped`.
- On GitHub workflow for CI, split steps into jobs.
- Update code style rules.
- Add PHP Version badge on README.

## UNRELEASED 2022-02-06

Update license year. Happy 2022!

Fixed CI. PHPStan was failing because missing types declaration on `EntriesPopulatorTest`.

Add PHP 8.1 to test matrix on build.

Migrate from `develop/install-development-tools` to `phive`.

Run test coverage on Scrutinizer CI.

## UNRELEASED 2021-09-25

Fixed CI. Infection fails because it is not working on PHP 7.4.
PHPUnit cannot create code coverage for infection on PHP 8.0; so, upgrade to PHP 8.0 is not a solution.
Install and run Infection throught Composer is the right workaround.

Improve wording and typos on `README` and `CONTRIBUTING`.

## Version 0.2.6 2020-06-17

There are no significant code changes, only some refactoring to improve testing and type understanding.

Integrate `psalm` and `infection` to build pipeline.

Change default branch from `master` to `main`

Move continuous integration to GitHub Actions. Thanks Travis-CI!

## Version 0.2.5 2021-06-08

Code changes:

- Remove creational abstract static methods for exceptions.

Development changes:

- Upgrade to `friendsofphp/php-cs-fixer:^3.0`.

CI:

- Add PHP 8.0 to Travis matrix build.
- Do not upgrade composer on scrutinizer since it is on a read-only file system.

## Version 0.2.4 2020-01-09

- It is not intented to create a breaking change, but strictly speaking there is one:
  The classes `GenericOverrideException` and `GenericNotFoundException` have changed making the class and `create` method
  `abstract`, also removed `TYPE_NAME` constant. It would only affect you in case that you are extending this clases.  
- Development:
    - Add `psalm` to `composer dev:build`.
    - Change `phpstan/phpstan-shim` to `phpstan/phpstan`.
    - Upgrade `phpstan` to `^0.12`.
    - Scrutinizer-CI: remove all development dependences but `phpunit`. 
- Update license year.
- Add more examples to compare two enums, use https on links.

## Version 0.2.3 2019-12-06

- Improve development environment
- Add PHP 7.4 to Travis CI

## Version 0.2.2 2019-09-30

- Allow syntax `@method static static name()`.
- Improve library type system, [psalm](https://github.com/vimeo/psalm) is 100% clean,
  not included as dev dependency yet. This fixes all issues at scrutinizer.
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

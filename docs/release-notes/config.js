const readFileSync = require('fs').readFileSync
const join = require('path').join

const releaseRules = [
  {type: 'breaking', release: 'major'},
  {type: 'feat', release: 'minor'},
  {type: 'feature', release: 'minor'},
  {type: 'fix', release: 'patch'},
  {type: 'hotfix', release: 'patch'},
  {type: 'chore', release: 'patch'},
];

const types = [
  {type: 'feat', section: 'Features'},
  {type: 'feature', section: 'Features'},
  {type: 'fix', section: 'Fixes'},
  {type: 'hotfix', section: 'Fixes'},
  {type: 'chore', section: 'Chores'},
];

config = {
  commitAnalyzer: {
    releaseRules: releaseRules,
  },
  releaseNotesGenerator: {
    preset: 'conventionalcommits',
    presetConfig: {
      types: types
    },
    writerOpts: {
      headerPartial: readFileSync(join(__dirname, 'templates/header.hbs'), 'utf-8'),
    },
  },
  changelog: {
    changelogFile: 'CHANGELOG.md',
    changelogTitle: '# Changelog',
  },
  github: {
    releasedLabels: 'v<%= nextRelease.gitTag %>',
  },
  git: {
    assets: 'CHANGELOG.md',
    message: '[v${gitVersion}] Update CHANGELOG',
  }
}

module.exports = config;

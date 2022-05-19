const readFileSync = require('fs').readFileSync
const join = require('path').join

module.exports = {
  branches: ['main'],
  tagFormat: 'v${version}',
  plugins: [
    ["@semantic-release/commit-analyzer", {
      releaseRules: [
        {type: 'breaking', release: 'major'},
        {type: 'feat', release: 'minor'},
        {type: 'feature', release: 'minor'},
        {type: 'fix', release: 'patch'},
        {type: 'hotfix', release: 'patch'},
        {type: 'chore', release: 'patch'},
      ],
      parserOpts: {
        noteKeywords: ['BREAKING CHANGE', 'BREAKING CHANGES', 'BREAKING']
      },
    }],
    ['@semantic-release/release-notes-generator', {
      presetConfig: {
        types: [
          {type: 'feat', section: 'Features'},
          {type: 'feature', section: 'Features'},
          {type: 'fix', section: 'Fixes'},
          {type: 'hotfix', section: 'Fixes'},
          {type: 'chore', section: 'Chores'},
        ],
      },
    }],
    ['@semantic-release/changelog', {
      changelogFile: 'CHANGELOG.md',
      changelogTitle: '# Release Notes',
    }],
    ['@semantic-release/github', {
      releasedLabels: 'v<%= nextRelease.gitTag %>',
    }],
    ['@semantic-release/git', {
      assets: 'CHANGELOG.md',
      message: 'Update CHANGELOG'
    }]
  ]
}

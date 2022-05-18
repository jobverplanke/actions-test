const readFileSync = require('fs').readFileSync
const join = require('path').join

module.exports = {
  branches: ['main'],
  tagFormat: 'v${version}',
  plugins: [
    ["@semantic-release/commit-analyzer", {
      preset: 'conventionalcommits',
      releaseRules: [
        {type: 'breaking', release: 'major'},
        {type: 'feat', release: 'minor'},
        {type: 'fix', release: 'patch'},
        {type: 'chore', release: 'patch'},
      ],
      parserOpts: {
        noteKeywords: ['BREAKING CHANGE', 'BREAKING CHANGES', 'BREAKING']
      },
    }],
    ['@semantic-release/release-notes-generator', {
      preset: 'conventionalcommits',
      presetConfig: {
        types: [
          {type: 'feat', section: 'Features'},
          {type: 'fix', section: 'Fixes'},
          {type: 'chore', section: 'Chores'},
        ],
      },
      writerOpts: {
        headerPartial: readFileSync(join(__dirname, 'tools/semantic-release/templates/header.hbs'), 'utf-8'),
      },
      parserOpts: {
        noteKeywords: ['BREAKING CHANGE', 'BREAKING CHANGES', 'BREAKING']
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
    }]
  ]
}

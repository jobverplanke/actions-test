module.exports = {
  branches: ['main'],
  tagFormat: 'v${version}',
  plugins: [
    ["@semantic-release/commit-analyzer", {
      releaseRules: [
        {type: 'breaking', release: 'major'},
        {type: 'feat', release: 'minor'},
        {type: 'fix', release: 'patch'},
        {type: 'chore', release: 'patch'},
      ],
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
    }],
    ['@semantic-release/changelog', {
      changelogFile: 'CHANGELOG.md',
      changelogTitle: '# Release Notes',
    }],
    ['@semantic-release/github', {
      releasedLabels: 'v<%= nextRelease.gitTag %>',
      assets: [{
        path: '',
        label: '${nextRelease.gitTag}.zip'
      }]
    }],
    ['@semantic-release/git', {
      assets: 'CHANGELOG.md',
    }]
  ]
}

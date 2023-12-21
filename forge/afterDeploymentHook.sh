echo 'Post deployment hooks';

jq -n --arg branch "$(git rev-parse --abbrev-ref HEAD)" --arg hash "$(git rev-parse --short HEAD)" --arg author "$(git --no-pager show -s --format='%an <%ae>')" --arg timestamp "$(date +%s)" '{branch: $branch, hash: $hash, author: $author, timestamp: $timestamp}' > ./storage/app/deployment.json

url=https://hooks.slack.com/services/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
payload='
{
  "text": ":rotating_light: *'$(git --no-pager show -s --format='%an')'* deployed to https://staging.'$1'",
  "attachments": [
    {
      "author_name": "Hash",
      "text": "https://github.com/Maurice-Brandfields/'$1'/commit/'$(git rev-parse --verify HEAD)'",
      "color": "#00a3e0"
    },
    {
      "author_name": "Manifest",
      "text":  "https://staging.'$1'/deployment",
      "color": "#00a3e0"
    }
  ]
}'

curl -s -X POST -H "Content-type: application/json" --data "$payload" $url

# Git Commands

* `git init`      # initialize directory as git repository 
* `git clone <url>`      #  copying git repository from hosted url  to local machine
* `git status`      #  show modified files in current directory
* `git log`      #  view your commit history
* `git add -A`      #  add changed files into your next commit (stage)
* `git commit -m 'your message'`      #  commit your changes
* `git pull origin main`      #  get up to date changes from main branch 
* `git push origin main`      #  push your changes to main branch
* `git branch`      #  list all local branches on the machine
* `git merge develop`      #  will merge develop branch into current one 
* `git branch <branch-name>`      #  will create new branch
* `git checkout <branch-name>`      #  switch from current to <branch-name> 
* `git branch -m <new-branch-name>`      #  will rename current branch 
* `git branch -d <branch-name>`      #  delete specified branch
* `git rm <file-name>`      #  remove file from project and stage removal
* `git stash`      #  save modified and staged changes
* `git diff <branch-A-name>...<branch-B-name>`      #  show what is on <branch-A-name>, but not on <branch-B-name>
* `git rebase <branch-name>`      #  put commits of current branch ahead of  branch <branch-name>
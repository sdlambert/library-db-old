https://forum.vuejs.org/t/vuex-mutations-single-changes-vs-single-responsibility/16396

### Mutations

* Should be the only place to directly update the state
* Do state changes as side effect
* Should not have other side effects (requests, async, global state changes, …)
* May contain logic
* Should try to do everything that is required to change the old state into a new consistent state
* Have to be synchronous
* Main guideline: time-travel using Vue Devtools should work reliably

### Actions

* Handle asynchronous behavior
* May commit mutations
* May call other actions
* May orchestrate multiple mutations & actions, if required
* Can return a promise to indicate their progress
* We should avoid using the promise’s payload value directly but always read required values from the store - if required

### Components

* Trigger an “intent” to change some state
* This may be a mutation or an action
* Should not contain business logic that makes assumptions about the shape of the store
* Could do e.g. input validation

Based on these guidelines, the consequence would be that a mutation might also change multiple properties of the state if it contributes to a “consistent” state that is left after that mutation has been executed.
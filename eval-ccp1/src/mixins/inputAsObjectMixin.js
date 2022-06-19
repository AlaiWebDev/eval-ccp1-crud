export default {
    methods: {
        inputAsObject(value) {
        value = value.replace(/[\n]/gm, ',');
            let contentFromInput = value.split(",");
                for (let index = 0; index < contentFromInput.length; index++) {
                  contentFromInput[index] = contentFromInput[index].split(":");
                }
            const entriesFromInput = new Map(contentFromInput);
            return Object.fromEntries(entriesFromInput);
      }
    }
  };
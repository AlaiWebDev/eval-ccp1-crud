export default {
    methods: {
        sortObject(object) {
            let sorted = {},
            key, a = [];
        
            for (key in object) {
                if (object.hasOwnProperty(key)) {
                    a.push(key);
                }
            }
        
            a.sort();
        
            for (key = 0; key < a.length; key++) {
                sorted[a[key]] = object[a[key]];
            }
            return sorted;
        }
    }
};
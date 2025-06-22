class LocalStorageHandler {
    static addToLocalStorageObject(name, key, objectArgs) {
        // get existing data
        let existingData = localStorage.getItem(name);
        existingData = existingData ? JSON.parse(existingData) : [];

        let obj = {};

        for (const [argKey, argVal] of Object.entries(objectArgs)) {
            obj[argKey] = argVal;
        }

        const propertyNameExist = existingData.some(setting => setting.hasOwnProperty(key));
        // add to local storage
        if(!propertyNameExist) {
            existingData.push({ [key]: {...obj } })
        }

        // update values
        if(propertyNameExist) {
            existingData.forEach(existing => {
                if(existing[key] != null) {
                    if(existing[key].name === obj.name) {
                        existing[key] = obj;
                    }
                }
            })
        }

        localStorage.setItem(name, JSON.stringify(existingData));
    }
    
    static retrieveLocalStorageObject(name) {
        return JSON.parse(localStorage.getItem(name));
    }

    static deleteLocalStorageObject(name) {
        localStorage.removeItem(name)
    }

    static expired(storageObject) {
        if(storageObject.expiry < Date.now()) {
            return true;
        }
        return false;
    }
}

export { LocalStorageHandler };
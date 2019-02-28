import { setTimeout } from "timers";

let students = new Array(
	"G018CXX11", "G018CXX21", "G018CXX31", "G018CXX41", "G018CXX51", "G018CXX61", "G018CXX71", "G018CXX81", "G018CXX91", 
	"G018CXX12", "G018CXX22", "G018CXX32", "G018CXX42", "G018CXX52", "G018CXX62", "G018CXX72", "G018CXX82", "G018CXX92",
	"G018CXX13", "G018CXX23", "G018CXX33", "G018CXX43", "G018CXX53", "G018CXX63", "G018CXX73", "G018CXX83", "G018CXX93",
	"G018CXX14", "G018CXX24", "G018CXX34", "G018CXX44", "G018CXX54", "G018CXX64", "G018CXX74", "G018CXX84", "G018CXX94",
	"G018CXX15", "G018CXX25", "G018CXX35", "G018CXX45", "G018CXX55", "G018CXX65", "G018CXX75", "G018CXX85", "G018CXX95",
	"G018CXX16", "G018CXX26", "G018CXX36", "G018CXX46", "G018CXX56", "G018CXX66", "G018CXX76", "G018CXX86", "G018CXX96",)

const shuffle = ([...arr]) => {
	let m = arr.length;
	while (m) {
		const i = Math.floor(Math.random() * m--);
		[arr[m], arr[i]] = [arr[i], arr[m]];
	}
	return arr;
};

function change() {
	let arrays = shuffle(students);
	let i = 0;
	for(let r = 0; r < 6; r++) {
		for(let c = 0; c < 9; c++) {
			setTimeout(() => {
				document.getElementById(r+"_"+c).classList.add("active");
				document.getElementById(r+"_"+c).innerHTML = arrays[i++];
				console.log(arrays[i]);
			}, 1500);
		}
	}
}


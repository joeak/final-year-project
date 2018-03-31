var CO_modules = [{"code":"COA102","title":"Web Design"},
{"code":"COA105","title":"Introduction to Algorithms"},
{"code":"COA107","title":"Logic and Functional Programming"},
{"code":"COA111","title":"Software Engineering 1"},
{"code":"COA122","title":"Programming for the WWW"},
{"code":"COA123","title":"Server Side Programming"},
{"code":"COA124","title":"Computer Systems"},
{"code":"COA220","title":"Databases"},
{"code":"COA256","title":"Mathematics for Computer Science"},
{"code":"COA900","title":"Object Oriented Programming"},
{"code":"COB100","title":"Guru Lectures for ITMB Students"},
{"code":"COB101","title":"Requirements Engineering"},
{"code":"COB106","title":"Formal Languages and Theory of Computation"},
{"code":"COB107","title":"AI Methods"},
{"code":"COB108","title":"Knowledge-Based Decision Support"},
{"code":"COB120","title":"Computer Graphics"},
{"code":"COB122","title":"Software Engineering 2"},
{"code":"COB150","title":"Formal Specification"},
{"code":"COB155","title":"Mobile Application Development"},
{"code":"COB201","title":"Professional Issues in Computing"},
{"code":"COB231","title":"Operating Systems, Networks and the Internet 1"},
{"code":"COB232","title":"Operating Systems, Networks and the Internet 2"},
{"code":"COB249","title":"Professional Training Preparation"},
{"code":"COB290","title":"Team Projects"},
{"code":"COB295","title":"Team Project"},
{"code":"COB301","title":"Industrial Expertise"},
{"code":"COC001","title":"Robotics"},
{"code":"COC003","title":"E-Business Planning and Marketing"},
{"code":"COC100","title":"Enterprise Resource Planning Systems"},
{"code":"COC101","title":"Agent-Based Systems"},
{"code":"COC102","title":"Advanced Artificial Intelligence Systems"},
{"code":"COC104","title":"Algorithm Analysis"},
{"code":"COC118","title":"Human-Computer Interaction"},
{"code":"COC131","title":"Data Mining"},
{"code":"COC140","title":"Cryptography and Network Security"},
{"code":"COC155","title":"Mobile Application Development"},
{"code":"COC180","title":"Implementation of Programming Languages"},
{"code":"COC190","title":"Advanced Networking"},
{"code":"COC200","title":"Markup Languages for the Web"},
{"code":"COC202","title":"Computer Vision"},
{"code":"COC220","title":"Computer Animation"},
{"code":"COC251","title":"Computer Science Project"},
{"code":"COC252","title":"Computing Project"},
{"code":"COC253","title":"IT Project"},
{"code":"COC255","title":"Computer Science and Mathematics Project"},
{"code":"COC257","title":"AI Project"},
{"code":"COC259","title":"Web Development Project"},
{"code":"COC260","title":"Investigative Project (Study Abroad Programme)"},
]
var CV_modules = [{"code":"CVA001","title":"Communication"},
{"code":"CVA002","title":"Fluid Mechanics"},
{"code":"CVA003","title":"Introduction to Structural Design"},
{"code":"CVA005","title":"Structural Analysis & Mechanics 1 & 2"},
{"code":"CVA007","title":"Integrated Sustainable Building Design"},
{"code":"CVA009","title":"Surveying 1"},
{"code":"CVA010","title":"Engineering Materials"},
{"code":"CVA011","title":"2D CAD and 3D BIM for Architectural Design"},
{"code":"CVA012","title":"History and Theory of Architecture"},
{"code":"CVA013","title":"Architectural Drawing and Representation"},
{"code":"CVA016","title":"Building Materials"},
{"code":"CVA018","title":"Principles of Law"},
{"code":"CVA019","title":"Principles of Design and Construction"},
{"code":"CVA021","title":"Site Surveying"},
{"code":"CVA022","title":"Building Environmental Science"},
{"code":"CVA023","title":"Surveying for Construction"},
{"code":"CVA025","title":"Project and Teamwork 1"},
{"code":"CVA026","title":"Building Production"},
{"code":"CVA028","title":"Construction and Commercial Management 1"},
{"code":"CVA029","title":"Principles of Design Management"},
{"code":"CVA030","title":"Methods of Measurement"},
{"code":"CVA031","title":"Research Assignment"},
{"code":"CVA041","title":"Introduction to Transport Systems"},
{"code":"CVA042","title":"Introduction to Management"},
{"code":"CVA043","title":"Introduction to Economics"},
{"code":"CVA044","title":"Introduction to Logistics"},
{"code":"CVA045","title":"Introduction to Air Transport"},
{"code":"CVA046","title":"Management Finance for the Transport Industry"},
{"code":"CVA047","title":"Transport and Society"},
{"code":"CVA049","title":"Introduction to Transport Economics"},
{"code":"CVA050","title":"Air Transport Technology"},
{"code":"CVB001","title":"Structural Design"},
{"code":"CVB002","title":"Geotechnics 1 and 2"},
{"code":"CVB003","title":"Hydraulics"},
{"code":"CVB004","title":"Surveying 2"},
{"code":"CVB005","title":" Construction Management"},
{"code":"CVB006","title":"Construction Law and Contract Procedure"},
{"code":"CVB008","title":"Structural Analysis & Mechanics 3"},
{"code":"CVB010","title":"Field Courses"},
{"code":"CVB018","title":"Civil and Building Engineering Law"},
{"code":"CVB019","title":"Low Energy Architectural Design"},
{"code":"CVB020","title":"Procurement and Contract Administration"},
{"code":"CVB021","title":"Management Principles and Practice"},
{"code":"CVB022","title":"Civil Engineering Measurement"},
{"code":"CVB024","title":"Contractors' Planning and Estimating"},
{"code":"CVB026","title":"Construction Technology and Management 2"},
{"code":"CVB028","title":"Building Services Technology"},
{"code":"CVB030","title":"Construction Organisation and Management"},
{"code":"CVB031","title":"Project and Teamwork 2"},
{"code":"CVB033","title":"Health & Safety"},

]


function departmentSelect(){
	console.log("running");
	if (document.getElementById("firstSelect").value == "CO"){
		var newHtml = "";
		newHtml = "<select id='moduleCode' name='moduleCode' class='form-control' onchange='titleSelect();'>";
		for(var i=0;i<CO_modules.length;i++){
				newHtml+="<option value='"+CO_modules[i].code+"'>"+CO_modules[i].code+"</option>";
		}
		newHtml+="</select>";
		document.getElementById("secondSelect").innerHTML = newHtml;
	}
	else if(document.getElementById("firstSelect").value == "CV"){
		var newHtml = "";
		newHtml = "<select id='moduleCode' name='moduleCode' class='form-control' onchange='titleSelect();'>";
		for(var i=0;i<CO_modules.length;i++){
				newHtml+="<option value='"+CV_modules[i].code+"'>"+CV_modules[i].code+"</option>";
		}
		newHtml+="</select>";
		document.getElementById("secondSelect").innerHTML = newHtml;
	}
};

function titleSelect(){
	var moduleCode = document.getElementById("moduleCode").value;
	for(var i=0;i<CO_modules.length;i++){
		if(moduleCode == CO_modules[i].code){
			document.getElementById("moduleTitle").value = CO_modules[i].title;
		}
	}
	for(var i=0;i<CV_modules.length;i++){
		if(moduleCode == CV_modules[i].code){
			document.getElementById("moduleTitle").value = CV_modules[i].title;
		}
	}
}